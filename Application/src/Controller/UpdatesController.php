<?php
namespace App\Controller;

use App\Controller\AppController;

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
        if (in_array($this->request->action, ['index','view', 'add','edit', 'delete'])) {
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
     * View method
     *
     * @param string|null $id Update id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $update = $this->Updates->get($id, [
            'contain' => ['Tickets', 'Users']
        ]);
        $this->set('update', $update);
        $this->set('_serialize', ['update']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $update = $this->Updates->newEntity();
        if ($this->request->is('post')) {
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
        if ($this->Updates->delete($update)) {
            $this->Flash->success(__('The update has been deleted.'));
        } else {
            $this->Flash->error(__('The update could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
