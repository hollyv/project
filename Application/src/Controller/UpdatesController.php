<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Updates Controller
 *
 * @property \App\Model\Table\UpdatesTable $Updates
 */
class UpdatesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
      public function isAuthorized($user)
    {
        // All registered users can view
        if (in_array($this->request->action, ['index','add','edit', 'delete', 'ticket'])) {
          return true;
        }
        return parent::isAuthorized($user);
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Tickets', 'Users']
        ];
        $this->set('updates', $this->paginate($this->Updates));
        $this->set('_serialize', ['updates']);
    }


    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        //get ticket details 
        $this->loadModel('Tickets');
        $ticket = $this->Tickets->get($id, [
        ]);
        $update = $this->Updates->newEntity();
        if ($this->request->is('post')) {
            $update = $this->Updates->patchEntity($update, $this->request->data);
            //if ticket has the new status then change to pending when update is saved
            if ($this->Updates->save($update)) {
                if($ticket->status == 'New'){
                    $ticketsTable = TableRegistry::get('Tickets');
                    $ticket = $ticketsTable->get($id);
                    $ticket->status = 'Pending';
                    $ticketsTable->save($ticket);
                }
                $this->Flash->success(__('The ticket has been updated'));
                return $this->redirect(['controller' => 'Updates', 'action' => 'ticket', $id]);
            } else {
                $this->Flash->error(__('The update could not be saved. Please, try again.'));
            }
        }
        $tickets = $this->Updates->Tickets->find('list', ['limit' => 200]);
        $users = $this->Updates->Users->find('list', ['limit' => 200]);
        $this->set(compact('update', 'tickets', 'users'));
        $this->set('_serialize', ['update']);
        $this->set('id', $id);
        
    }

    public function ticket($id = null)
    {

        $results = $this->Updates->find()->contain([
            'Users' => function ($q) {
                return $q
                        ->select(['username']);
            }
        ]);
        $results->orderDesc('created');

        $this->loadModel('Tickets');
        $ticket = $this->Tickets->get($id, [
            'contain' => ['Customers', 'Priorities', 'Users', 'Updates']
        ]);
        $this->set(['results'=> $results,
            'id'=> $id,
            'ticket'=>$ticket]);

    }

    public function analyst()
    {
        $loguser = $this->request->session()->read('Auth.User.id');

        $this->paginate = [
            'contain' => ['Tickets'],
            'conditions'=>array('Updates.analyst_id' => $loguser,
                                'Updates.update_text NOT LIKE' => 'SYSTEM%'),
            'limit' => 8
        ];
        
       $query = $this->Updates->find()->innerJoinWith(
           'Tickets', function ($q) {
           return $q->where(['Updates.analyst_id' => 7]);
           }
        );

       $this->set('updates', $this->paginate($this->Updates));
        $this->set('_serialize', ['updates']);

        $this->set([
            'query'=> $query]);

    }

    /**
     * Edit method
     *
     * @param string|null $id Update id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $update = $this->Updates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $update = $this->Updates->patchEntity($update, $this->request->data);
            if ($this->Updates->save($update)) {
                $this->Flash->success(__('The update has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The update could not be saved. Please, try again.'));
            }
        }
        $tickets = $this->Updates->Tickets->find('list', ['limit' => 200]);
        $users = $this->Updates->Users->find('list', ['limit' => 200]);
        $this->set(compact('update', 'tickets', 'users'));
        $this->set('_serialize', ['update']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Update id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $update = $this->Updates->get($id);
        $ticket = $update->ticket_id;
        if ($this->Updates->delete($update)) {
            $this->Flash->success(__('The update has been deleted.'));
        } else {
            $this->Flash->error(__('The update could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'ticket', $ticket]);
    }
}
