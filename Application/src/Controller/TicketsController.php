<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;

/**
 * Tickets Controller
 *
 * @property \App\Model\Table\TicketsTable $Tickets
 */

class TicketsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
        public function isAuthorized($user)
    {
        // All registered users can view
        if (in_array($this->request->action, ['index','view', 'add','edit', 'delete','homepage','assign','search','status','users', 'allReports', 'kpi'])) {
          return true;
        }

           if ($user['role'] !== 'Manager'){
            $this->Flash->error(__('You do not have permission to perform this action.'));
        }
        return parent::isAuthorized($user);
   
}     

    public function index()
    {

        $this->paginate = [
            'contain' => ['Customers', 'Priorities', 'Users'],
            'limit' => 8
        ];
        $this->set('tickets', $this->paginate($this->Tickets));

        $this->set('_serialize', ['tickets']);
    }

    public function add()
    {
        $ticket = $this->Tickets->newEntity();
        if ($this->request->is('post')) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->data);
            //if ticket saves correctly then alert success and email the customer if user selected email option
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('The ticket has been saved.'));
                      if ($this->request->data('email_option') == "Yes"){
                        //query to get customer email address
                        $query = $this->Tickets->find()->contain([
                            'Customers' => function ($q) {
                               return $q
                                    ->select(['email'])
                                    ->distinct(['email'])
                                    ->where(['Tickets.customer_id'=> $this->request->data('customer_id')]);
                            }
                        ]);
                      //$row = $query->first();

                //$emailadd = $row->customer->email;
              //cho $emailadd;
                //email
                $email = new Email('default');
                 $email = new Email();
                 //$email->viewVars(['emailadd' => $emailadd]);
                 $email->from(['hollyvoysey@gmail.com' => 'Numatic Helpdesk'])
                 //->to($emailadd)
                 ->to('holly.voysey@students.plymouth.ac.uk')
                 ->emailFormat('both')
                 ->template('ticket', 'ticket')
                 ->subject('Numatic Helpdesk System - New Ticket')
                 ->viewVars(['created' => $ticket->created->format('d-M-y H:i'),
                             'ticket' => $this->request->data,
                             'user' => $this->request->session()->read('Auth.User.username')])
                 ->send();
                 
                                  
               }
                return $this->redirect(['controller' => 'Tickets','action' => 'users',
            $loguser = $this->request->session()->read('Auth.User.id')]);
            } else {
                $this->Flash->error(__('The ticket could not be saved. Please, try again.'));
            }
        }

        $customers = $this->Tickets->Customers->find('list', ['limit' => 200]);
        $priorities = $this->Tickets->Priorities->find('list', ['limit' => 200]);
        $users = $this->Tickets->Users->find('list', ['limit' => 200]);
        $this->set(compact('ticket', 'customers', 'priorities', 'users'));
        $this->set('_serialize', ['ticket']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ticket id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ticket = $this->Tickets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->data);
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('The ticket has been saved.'));
                return $this->redirect(['controller' => 'Tickets','action' => 'users',
            $loguser = $this->request->session()->read('Auth.User.id')]);
            } else {
                $this->Flash->error(__('The ticket could not be saved. Please, try again.'));
            }
        }
        $customers = $this->Tickets->Customers->find('list', ['limit' => 200]);
        $priorities = $this->Tickets->Priorities->find('list', ['limit' => 200]);
        $users = $this->Tickets->Users->find('list', ['limit' => 200]);
        $this->set(compact('ticket', 'customers', 'priorities', 'users'));
        $this->set('_serialize', ['ticket']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ticket id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ticket = $this->Tickets->get($id);
        if ($this->Tickets->delete($ticket)) {
            $this->Flash->success(__('The ticket has been deleted.'));
        } else {
            $this->Flash->error(__('The ticket could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    //assigned method
    public function users($id = null){
    
          $this->paginate = [
            'contain' => ['Customers', 'Priorities', 'Users'],
            'conditions'=>array('Tickets.analyst_id' => $id,
                                'Tickets.status !=' => 'Closed'),
            'limit' => 8
        ];
        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set('_serialize', ['tickets']);
    
    }

    public function assign($id = null){
      $ticket = $this->Tickets->get($id, [
            'contain' => []
        ]);
      //$user = $ticket["analyst_id"];   

        //saving ticket update (the new user assigned)
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->data);
            if ($this->Tickets->save($ticket)) {

              //getting new assigned username
              $this->loadModel('Users');
              $userDetails = $this->Users->find('all', array(
                                'conditions'=>array('id'=>$ticket->analyst_id)
              ));
              $row = $userDetails->first();

              //creating new update with details of who ticket has been assigned to 
              $updatesTable = TableRegistry::get('Updates');
              $newUpdate = $updatesTable->newEntity();
              $newUpdate->ticket_id = $id;
              $newUpdate->analyst_id = $this->request->session()->read('Auth.User.id');
              $newUpdate->update_text = "SYSTEM: Ticket assigned to " . $row->username;
              $updatesTable->save($newUpdate);

              //flash success message 
              $this->Flash->success(__('The ticket has been assigned.'));
              return $this->redirect(['controller' => 'Updates','action' => 'ticket', $id ]);
            } 
            else {
                $this->Flash->error(__('The ticket could not be saved. Please, try again.'));
            }
        }
        $customers = $this->Tickets->Customers->find('list', ['limit' => 200]);
        $priorities = $this->Tickets->Priorities->find('list', ['limit' => 200]);
        $users = $this->Tickets->Users->find('list', ['limit' => 200]);
        $this->set(compact('ticket', 'customers', 'priorities', 'users'));
        $this->set('_serialize', ['ticket']);
    }

    public function status() {

            $this->paginate = [
            'contain' => ['Customers', 'Priorities', 'Users'],
            'conditions'=>array('Tickets.status !=' =>'Closed'),
            'limit' => 8
        ];
        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set('_serialize', ['tickets']);
    }

    public function priority($id = null) {

            $this->paginate = [
            'contain' => ['Customers', 'Priorities', 'Users'],
            'conditions'=>array('Tickets.priority_id' => $id),
            'limit' => 8
        ];

        $this->loadModel('Priorities');
        $priorityDetails = $this->Priorities->find('all', array(
            'conditions'=>array('Priorities.id'=>$id)
        ));

        $row = $priorityDetails->first();
        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set('row', $row);
        $this->set('_serialize', ['tickets']);
    }

    public function watched($id = null) {
      //loading watchedTickets model and finding all watched tickets for user
        $this->loadModel('WatchedTickets');
        $watched = $this->WatchedTickets->find('all', array(
            'conditions'=>array('WatchedTickets.analyst_id'=>$id)
        ));

        //for every watched ticket get ticket info
        $i = 0;
        $tickets = array ();
        foreach ($watched as $w) {
             $ticket = $this->Tickets->get($w->ticket_id, [
            'contain' => ['Customers', 'Priorities', 'Users']
            ]);
            $tickets[$i] = $ticket;
            $i = $i + 1; 
        }
        $this->set(['tickets'=> $tickets,
                    'watched'=> $watched]);
    }

    public function search() {
      //getting entered variable and putting wildcards around it
      $entered = $_POST["search"];
      $wildcardVar = "%" . $entered . "%";

        //looking for search variable in the id, title and description fields.
        $foundTickets = $this->Tickets->find()
          ->where(['Tickets.id'=>$entered])
          ->orWhere(['Tickets.title LIKE' => $wildcardVar])
          ->orWhere(['Tickets.description LIKE' => $wildcardVar]);

        //setting variables 
        $this->set(['foundTickets' => $foundTickets,
                    'entered'=>$entered]);
        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set('_serialize', ['tickets']);
    }

    public function individual(){
      $this->loadModel('Users');
      $users = $this->Users->find('list');
        $this->set(compact('users'));

        if ($this->request->is('post')) {
          $this->redirect(['controller' => 'Updates','action' => 'analyst', $this->request->data('users')]);
        }
    }

    public function resolve($id = null){
      //editing ticket details to update the status to resolved and adding resolution date with timestamp.
      //once done, it flashes success and redirects user to the previous page.
      $ticketsTable = TableRegistry::get('Tickets');
      $ticket = $ticketsTable->get($id);
      $ticket->status = 'Resolved';
      $ticket->resolution_date = time();
      $ticketsTable->save($ticket);

      $updatesTable = TableRegistry::get('Updates');
      $newUpdate = $updatesTable->newEntity();
      $newUpdate->ticket_id = $id;
      $newUpdate->analyst_id = $this->request->session()->read('Auth.User.id');
      $newUpdate->update_text = "SYSTEM: Ticket Resolved";
      $updatesTable->save($newUpdate);

      $this->Flash->success(__('The ticket has been resolved.'));
      return $this->redirect(['controller' => 'Updates','action' => 'ticket', $ticket->id]);
      }

      public function close($id = null){
      //editing ticket details to update the status to closed.
      //once done, it flashes success and redirects user to the previous page.
      $ticketsTable = TableRegistry::get('Tickets');
      $ticket = $ticketsTable->get($id);
      $ticket->status = 'Closed';
      $ticketsTable->save($ticket);
      
      $updatesTable = TableRegistry::get('Updates');
      $newUpdate = $updatesTable->newEntity();
      $newUpdate->ticket_id = $id;
      $newUpdate->analyst_id = $this->request->session()->read('Auth.User.id');
      $newUpdate->update_text = "SYSTEM: Ticket Closed";
      $updatesTable->save($newUpdate);

      $this->Flash->success(__('The ticket has been closed.'));
      return $this->redirect(['controller' => 'Updates','action' => 'ticket', $ticket->id]);
        
      }

      public function open($id = null){
      //editing ticket details to update the status to open.
      //once done, it flashes success and redirects user to the previous page.
      $ticketsTable = TableRegistry::get('Tickets');
      $ticket = $ticketsTable->get($id);
      $ticket->status = 'Pending';
      $ticketsTable->save($ticket);

      $updatesTable = TableRegistry::get('Updates');
      $newUpdate = $updatesTable->newEntity();
      $newUpdate->ticket_id = $id;
      $newUpdate->analyst_id = $this->request->session()->read('Auth.User.id');
      $newUpdate->update_text = "SYSTEM: Ticket re-opened";
      $updatesTable->save($newUpdate);

      $this->Flash->success(__('The ticket has been re-opened.'));
      return $this->redirect(['controller' => 'Updates','action' => 'ticket', $ticket->id]);
      }

      public function overdue(){

        $results = $this->Tickets->find('all', array(
            'conditions'=>array('Tickets.status !=' =>'Closed')
          ));

        $i = 0;
        $overdue = array ();
        $diffence = array ();
        $j = 0;
        $overdueTickets = array ();
        foreach ($results as $t):

              if ($t->priority_id == 1) {       
                $dueDate = date_add($t->created,date_interval_create_from_date_string("24 hours"));
              }
              elseif($t->priority_id == 2){
                $dueDate = date_add($t->created,date_interval_create_from_date_string("1 week"));
              }
              else{
                $dueDate = date_add($t->created,date_interval_create_from_date_string("1 month"));
              }

              $current = date('m/d/Y', time());
              
              $date2=date_create("2013/03/15");
              //$diff=date_diff($date2,$current);
              if(strtotime($dueDate) < strtotime($current))
              {
                 $ticketDetails = $this->Tickets->get($t->id, [
                  'contain' => ['Customers', 'Priorities', 'Users']
                  ]);
                  $overdueTickets[$j] = $ticketDetails;
                  $j = $j + 1; 
                $overdue[$i] = $t;
              }
              $i = $i + 1;

        endforeach;
        $this->set(['overdueTickets'=> $overdueTickets,
                    'overdue'=> $overdue,
                    'diffence'=> $diffence ]);



      }


    public function advsearch() {
       $ticket = $this->Tickets->newEntity();
        if ($this->request->is('post')) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->data);
            //if ticket saves correctly then alert success and email the customer if user selected email option

        }

        $wildcardVar = $ticket['title'];

        $foundTickets = $this->Tickets->find()
          ->where(['Tickets.title LIKE' => $wildcardVar]);


        $customers = $this->Tickets->Customers->find('list', ['limit' => 200]);
        $priorities = $this->Tickets->Priorities->find('list', ['limit' => 200]);
        $users = $this->Tickets->Users->find('list', ['limit' => 200]);
        $this->set(compact('ticket', 'customers', 'priorities', 'users'));
        $this->set('_serialize', ['ticket']);
     
        

    }

    public function allReports(){

    }

    public function reports(){

      //getting data for number of tickets per analyst chart
        $this->loadModel('Users');
        $analysts = $this->Users->find();
        $analysts->select(['id', 'username'])
                 ->distinct(['username']);

        $numTickets = array();
        $i=0;
        foreach ($analysts as $a) {          
            $ticket = $this->Tickets->find('all', array(
                  'conditions'=>array('Tickets.analyst_id'=> $a->id,
                                      'Tickets.status !=' =>'Closed')
            ));
            $ticketCount = $ticket->count();
            $numTickets[$i] = $ticketCount;
            $i = $i + 1;
        }  

        //Getting data for number of tickets per dept chart
        $query = $this->Tickets->find()->contain([
                      'Users' => function ($q) {
                              return $q
                                  ->select(['supportteam'])
                                  ->where(['Users.supportteam'=> 'DBA',
                                           'Tickets.status !=' =>'Closed']);
                            }
                        ]);
        $dba = $query->count();

        $bsquery = $this->Tickets->find()->contain([
                      'Users' => function ($q) {
                              return $q
                                  ->select(['supportteam'])
                                  ->where(['Users.supportteam'=> 'Business Systems',
                                           'Tickets.status !=' =>'Closed']);
                            }
                        ]);
        $bs = $bsquery->count();

        $fsquery = $this->Tickets->find()->contain([
                      'Users' => function ($q) {
                              return $q
                                  ->select(['supportteam'])
                                  ->where(['Users.supportteam'=> 'Functional Support',
                                           'Tickets.status !=' =>'Closed']);
                            }
                        ]);
        $fs = $fsquery->count();

        $infaQuery = $this->Tickets->find()->contain([
                      'Users' => function ($q) {
                              return $q
                                  ->select(['supportteam'])
                                  ->where(['Users.supportteam'=> 'Infrastructure',
                                            'Tickets.status !=' =>'Closed']);
                            }
                        ]);
        $infa = $infaQuery->count();

        $nsQuery = $this->Tickets->find()->contain([
                      'Users' => function ($q) {
                              return $q
                                  ->select(['supportteam'])
                                  ->where(['Users.supportteam'=> 'Network Support',
                                           'Tickets.status !=' =>'Closed']);
                            }
                        ]);
        $ns = $nsQuery->count();

        $psQuery = $this->Tickets->find()->contain([
                      'Users' => function ($q) {
                              return $q
                                  ->select(['supportteam'])
                                  ->where(['Users.supportteam'=> 'Projects and Admin',
                                            'Tickets.status !=' =>'Closed']);
                            }
                        ]);
        $ps = $psQuery->count();


      $month = date('Y-m-d', strtotime('-30 days'));
      $week = date('Y-m-d', strtotime('-7 days'));
      //Working out timebookings per analyst
      $this->loadModel('Updates');
        foreach ($analysts as $a) {
        
        $user = $this->Updates->find('all', array(
          'conditions'=>array('Updates.analyst_id'=>$a['id'],
                              'Updates.created >=' => $month)
        ));
        $user->select(['time_booking' => $user->func()->sum('time_booking')]);
        $total = $user->first();
        $booking[$a->username] = $total;
      
      }

      foreach ($analysts as $a) {
        
        $user = $this->Updates->find('all', array(
          'conditions'=>array('Updates.analyst_id'=>$a['id'],
                              'Updates.created >=' => $week)
        ));
        $user->select(['time_booking' => $user->func()->sum('time_booking')]);
        $total = $user->first();
        $weekBooking[$a->username] = $total;
      
      }

      //Working out resolution time per analyst
      foreach ($analysts as $a) {          
            $resolved = $this->Tickets->find('all', array(
                  'conditions'=>array('Tickets.analyst_id'=> $a->id,
                    'Tickets.resolution_date !='=> 'null')
            ));
            $countResolved = $resolved->count();
          $i = 0;
          $diffArray = array();
          foreach ($resolved as $r) {
              $diff=date_diff($r->created,$r->resolution_date);
              $diff = $diff->format("%a");
              $diffArray[$i] = $diff;
              $i = $i + 1;
          }
          
          if (count($diffArray) > 0){
          $average =  array_sum($diffArray) /count($diffArray);
          }
          else{
            $average = 0;
          }

          $avgTime[$a->username] = $average;
        }  


        $this->set(['analysts'=> $analysts,
                    'numTickets' => $numTickets,
                    'dba' => $dba,
                    'bs' => $bs,
                    'fs' => $fs,
                    'infa' => $infa,
                    'ps' => $ps,
                    'ns' => $ns,
                    'avgTime'=> $avgTime,
                    'booking'=> $booking,
                    'weekBooking'=> $weekBooking]);
    }
  

    public function homepage() {
    $loguser = $this->request->session()->read('Auth.User.id');
    $user = '%' . $this->request->session()->read('Auth.User.username') . '%';

       $results = $this->Tickets->find('all', array(
            'conditions'=>array('Tickets.status !=' =>'Closed',
                                'Tickets.analyst_id' => $loguser)
          ));

        $i = 0;
        $overdue = array ();
        $diffence = array ();
        $j = 0;
        $overdueTickets = array ();
        foreach ($results as $t):

              if ($t->priority_id == 1) {       
                $dueDate = date_add($t->created,date_interval_create_from_date_string("24 hours"));
              }
              elseif($t->priority_id == 2){
                $dueDate = date_add($t->created,date_interval_create_from_date_string("1 week"));
              }
              else{
                $dueDate = date_add($t->created,date_interval_create_from_date_string("1 month"));
              }

              $current = date('m/d/Y', time());
              
              $date2=date_create("2013/03/15");
              //$diff=date_diff($date2,$current);
              if((strtotime($dueDate) < strtotime($current)) && ($j < 4))
              {
                 $ticketDetails = $this->Tickets->get($t->id, [
                  'contain' => ['Customers', 'Priorities', 'Users']
                  ]);
                  $overdueTickets[$j] = $ticketDetails;
                  $j = $j + 1; 
                $overdue[$i] = $t;
              }
              $i = $i + 1;
        endforeach;


    $myTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.analyst_id'=>$loguser,
                           'Tickets.status !=' =>'Closed')
    ));

    $myHighTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.analyst_id'=>$loguser,
                            'Tickets.priority_id'=>'1',
                            'Tickets.status !=' =>'Closed')
    ));

    $myMedTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.analyst_id'=>$loguser,
                            'Tickets.priority_id'=>'2',
                            'Tickets.status !=' =>'Closed')
    ));

    $myLowTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.analyst_id'=>$loguser,
                            'Tickets.priority_id'=>'3',
                            'Tickets.status !=' =>'Closed')
    ));

    $myOngoingTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.analyst_id'=>$loguser,
                            'Tickets.priority_id'=>'4',
                            'Tickets.status !=' =>'Closed')
    ));

    $this->loadModel('Updates');
    $sysUpdates = $this->Updates->find('all', array(
          'conditions'=>array('Updates.update_text LIKE'=> '%SYSTEM%',
                              'Updates.update_text LIKE'=> $user ),
          'limit' => 7
    ));
    $sysUpdates->orderDesc('created');

    $mytotal = $myTickets->count();
    $myHigh = $myHighTickets->count();
    $myMed = $myMedTickets->count();
    $myLow = $myLowTickets->count();
    $myOngoing = $myOngoingTickets->count();
    $overdue = $this->overdueTickets;


    $cat=array("Computer Set Up"=>null, "E-mail"=>null, "Hardware"=>null, "Intranet"=>null, "Internet"=>null, "Network"=>null,
               "Phones"=>null, "Printers"=>null, "Scanners"=>null, "Software"=>null, "Virus"=>null, "Other"=>null);

    foreach($cat as $x=>$x_value){
      $catTickets = $this->Tickets->find('all', array(
                    'conditions'=>array('Tickets.category'=>$x,
                           'Tickets.status !=' =>'Closed')
                    ));
      $count = $catTickets->count();
      $cat[$x] = $count;
    }
    arsort($cat);
    $num = count($cat);
    $num = $num -5;
    $cat2 = array_slice($cat,$num);

    $this->set(['mytotal'=>$mytotal,
                'myHigh'=>$myHigh,
                'myMed'=>$myMed,
                'myLow'=>$myLow,
                'myOngoing'=>$myOngoing,
                'sysUpdates'=>$sysUpdates,
                'overdueTickets'=>$overdueTickets,
                'overdue' => $overdue,
                'cat'=>$cat,
                'cat2'=>$cat2, 
                'results'=>$results
                ]);

    }

        public function kpi() {
    $loguser = $this->request->session()->read('Auth.User.id');
    $totalTickets = $this->Tickets->find('all');

    $highTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.priority_id'=>'1',
                           'Tickets.status !=' =>'Closed')
    ));

    $medTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.priority_id'=>'2',
                           'Tickets.status !=' =>'Closed')
    ));

    $lowTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.priority_id'=>'3',
                           'Tickets.status !=' =>'Closed')
    ));

    $ongoingTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.priority_id'=>'4',
                            'Tickets.status !=' =>'Closed')
    ));

    $incidentTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.ticket_type'=>'Incident',
                            'Tickets.status !=' =>'Closed')
    ));

    $requestTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.ticket_type'=>'Request',
                            'Tickets.status !=' =>'Closed')
    ));

    $problemTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.ticket_type'=>'Problem',
                            'Tickets.status !=' =>'Closed')
    ));

    $newTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.status' =>'New')
    ));

    $pendingTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.status' =>'Pending')
    ));

    $resolvedTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.status' =>'Resolved')
    ));


    $high = $highTickets->count();
    $medium = $medTickets->count();
    $low = $lowTickets->count();
    $ongoing = $ongoingTickets->count();
    $total = $totalTickets->count();
    $incident = $incidentTickets->count();
    $problem = $problemTickets->count();
    $request = $requestTickets->count();
    $new = $newTickets->count();
    $pending = $pendingTickets->count();
    $resolved = $resolvedTickets->count();

    $this->loadModel('Departments');
    $dep = $this->Departments->find('all');

    foreach ($dep as $d){

      $this->paginate = [
            'contain' => ['Customers', 'Priorities', 'Users'],
            'conditions'=>array('Customers.department_id' => $d->id,
                                'Tickets.status !=' =>'Closed'),
        ];
        $tickets = $this->paginate($this->Tickets);

        if (strpos($d->name, '&') !== false) {
          $d->name = 'R\u0026D';
        }

        $count = $tickets->count();
        $depInfo[$d->name] = $count;
    }

    $cat=array("Computer Set Up"=>null, "E-mail"=>null, "Hardware"=>null, "Intranet"=>null, "Internet"=>null, "Network"=>null,
               "Phones"=>null, "Printers"=>null, "Scanners"=>null, "Software"=>null, "Virus"=>null, "Other"=>null);

    foreach($cat as $x=>$x_value){
      $catTickets = $this->Tickets->find('all', array(
                    'conditions'=>array('Tickets.category'=>$x,
                           'Tickets.status !=' =>'Closed')
                    ));
      $count = $catTickets->count();
      $cat[$x] = $count;
    }
    arsort($cat);
    $num = count($cat);
    $num = $num -5;
    $cat2 = array_slice($cat,$num);

    $this->set(['high'=> $high,
                'medium' => $medium,
                'low' => $low,
                'ongoing' => $ongoing,
                'total'=> $total,
                'incident'=>$incident,
                'problem'=>$problem,
                'request'=>$request,
                'depInfo'=>$depInfo,
                'new'=> $new,
                'pending'=> $pending,
                'resolved'=>$resolved,
                'cat'=>$cat,
                'cat2'=>$cat2
                ]);

    }

}
