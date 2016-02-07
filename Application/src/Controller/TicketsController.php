<?php
namespace App\Controller;

use App\Controller\AppController;

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
            'limit' => 10
        ];
        $this->set('tickets', $this->paginate($this->Tickets));

        $this->set('_serialize', ['tickets']);

    }

    /**
     * View method
     *
     * @param string|null $id Ticket id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ticket = $this->Tickets->get($id, [
            'contain' => ['Customers', 'Priorities', 'Users', 'Updates']
        ]);
        $this->set('ticket', $ticket);
        $this->set('_serialize', ['ticket']);
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

    public function status() {

          $tickets = $this->Tickets->find('all', array(
            'conditions'=>array('Tickets.status !=' =>'Closed')
          ));

          $this->set('tickets', $tickets);
    }

    public function search() {

      $entered = $_POST["search"];
      $wildcardVar = "%" . $entered . "%";

        $foundTickets = $this->Tickets->find()
          ->where(['Tickets.id'=>$entered])
          ->orWhere(['Tickets.title LIKE' => $wildcardVar])
          ->orWhere(['Tickets.description LIKE' => $wildcardVar]);


        $this->set(['foundTickets' => $foundTickets,
                    'entered'=>$entered]);
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
                'request'=>$request]);

    }

    public function countQuery(){
     $query = $tickets->find('all', [
        'conditions' => ['Tickets.priority_id IS' => 'High']
    ]);
    $number = $query->count();
    return $number;
    }



}
