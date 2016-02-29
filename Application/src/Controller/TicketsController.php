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
        if (in_array($this->request->action, ['index','view', 'add','edit', 'delete','homepage','assign','search','status','users'])) {
          return true;
        return parent::isAuthorized($user);
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


    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
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
                      $row = $query->first();

                $emailadd = $row->customer->email;
                //email
                $email = new Email('default');
                 $email->from(['hollyvoysey@gmail.com' => 'Numatic Helpdesk'])
                 ->to($emailadd)
                 ->subject('Numatic Helpdesk System - New Ticket')
                 ->send();
                 
               }
                return $this->redirect(['action' => 'index']);
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
                return $this->redirect(['action' => 'index']);
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

    public function users(){
        //getting all passed parameters
        $users = $this->request->params['pass'];

        // Use the TicketsTable to find tickets by users.
        $tickets = $this->Tickets->find('assigned', [
        'users' => $users
    ]);
        $this->set([
        'tickets' => $tickets,
        'users' => $users
    ]);
    }

    public function assign($id = null){
      $ticket = $this->Tickets->get($id, [
            'contain' => []
        ]);
      $user = $ticket["analyst_id"];

        if ($this->request->is(['patch', 'post', 'put'])) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->data);
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('The ticket has been saved.'));
                //email confirmation
                 $email = new Email('default');
                 $email->from(['hollyvoysey@gmail.com' => 'Numatic Helpdesk Application'])
                 ->to('holly.voysey@students.plymouth.ac.uk')
                 ->subject('test')
                 ->send('request data' );
                return $this->redirect(['action' => 'index']);
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

    public function status() {

          $tickets = $this->Tickets->find('all', array(
            'conditions'=>array('Tickets.status !=' =>'Closed')
          ));

          $query = $this->Tickets->find()->contain([
                'Priorities',
                'Users',
                'Customers' => function ($q) {
                               return $q
                                    ->select('username')
                                    ->where(['Tickets.status !='=> 'Closed']);
                            }
                        ]);
                    
          $this->set('query', $query);
          $this->set('tickets', $tickets);
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

    public function resolve($id = null){
      //editing ticket details to update the status to resolved and adding resolution date with timestamp.
      //once done, it flashes success and redirects user to the previous page.
      $ticketsTable = TableRegistry::get('Tickets');
      $ticket = $ticketsTable->get($id);
      $ticket->status = 'Resolved';
      $ticket->resolution_date = time();
      $ticketsTable->save($ticket);
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
      $this->Flash->success(__('The ticket has been re-opened.'));
      return $this->redirect(['controller' => 'Updates','action' => 'ticket', $ticket->id]);
      }

      public function overdue(){
         $tickets = $this->Tickets->find('all', array(
            'conditions'=>array('Tickets.status !=' =>'Closed')
          ));


        $i = 0;
        $overdue = array ();
        $diffence = array ();

        foreach ($tickets as $t):


        

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
        
        

        if(strtotime($dueDate) < strtotime($current))
        {
        
          $overdue[$i] = $t;

        }


        $i = $i + 1;

        endforeach;
        $this->set(['tickets'=> $tickets,
                    'overdue'=> $overdue,
                    'diffence'=> $diffence ]);

      }


    public function advsearch() {
      //need to do.
      $ticket = $this->Tickets->newEntity();
        
        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set('_serialize', ['tickets']);
    }
  

    public function homepage() {
    $loguser = $this->request->session()->read('Auth.User.id');
    $totalTickets = $this->Tickets->find('all');

    $highTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.priority_id'=>'1')
    ));

    $medTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.priority_id'=>'2')
    ));

    $lowTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.priority_id'=>'3')
    ));

    $ongoingTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.priority_id'=>'4')
    ));

    $myTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.analyst_id'=>$loguser)
    ));

    $myHighTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.analyst_id'=>$loguser,
                            'Tickets.priority_id'=>'1')
    ));

    $myMedTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.analyst_id'=>$loguser,
                            'Tickets.priority_id'=>'2')
    ));

    $myLowTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.analyst_id'=>$loguser,
                            'Tickets.priority_id'=>'3')
    ));

    $myOngoingTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.analyst_id'=>$loguser,
                            'Tickets.priority_id'=>'4')
    ));

    $incidentTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.ticket_type'=>'Incident')
    ));

    $requestTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.ticket_type'=>'Request')
    ));

    $problemTickets = $this->Tickets->find('all', array(
       'conditions'=>array('Tickets.ticket_type'=>'Problem')
    ));


    $high = $highTickets->count();
    $medium = $medTickets->count();
    $low = $lowTickets->count();
    $ongoing = $ongoingTickets->count();
    $total = $totalTickets->count();
    $mytotal = $myTickets->count();
    $myHigh = $myHighTickets->count();
    $myMed = $myMedTickets->count();
    $myLow = $myLowTickets->count();
    $myOngoing = $myOngoingTickets->count();
    $incident = $incidentTickets->count();
    $problem = $problemTickets->count();
    $request = $requestTickets->count();

    $this->set(['high'=> $high,
                'medium' => $medium,
                'low' => $low,
                'ongoing' => $ongoing,
                'total'=> $total,
                'mytotal'=>$mytotal,
                'myHigh'=>$myHigh,
                'myMed'=>$myMed,
                'myLow'=>$myLow,
                'myOngoing'=>$myOngoing,
                'incident'=>$incident,
                'problem'=>$problem,
                'request'=>$request
                ]);

    }

    public function countQuery(){
     $query = $tickets->find('all', [
        'conditions' => ['Tickets.priority_id IS' => 'High']
    ]);
    $number = $query->count();
    return $number;
    }



}
