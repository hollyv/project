<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Priorities Controller
 *
 * @property \App\Model\Table\PrioritiesTable $Priorities
 */
class PrioritiesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */

      public function isAuthorized($user)
    {
        // All registered users can view
        if (in_array($this->request->action, [])) {
          return true;
        }

        //Flash error if they don't have permission
        if ($user['role'] !== 'Manager'){
            $this->Flash->error(__('You do not have permission to perform this action.'));
        }
        return parent::isAuthorized($user);
    }

    public function index()
    {
        $this->set('priorities', $this->paginate($this->Priorities));
        $this->set('_serialize', ['priorities']);
    }

    /**
     * View method
     *
     * @param string|null $id Priority id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $priority = $this->Priorities->get($id, [
            'contain' => ['Tickets']
        ]);
        $this->set('priority', $priority);
        $this->set('_serialize', ['priority']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $priority = $this->Priorities->newEntity();
        if ($this->request->is('post')) {
            $priority = $this->Priorities->patchEntity($priority, $this->request->data);
            if ($this->Priorities->save($priority)) {
                $this->Flash->success(__('The priority has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The priority could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('priority'));
        $this->set('_serialize', ['priority']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Priority id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $priority = $this->Priorities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $priority = $this->Priorities->patchEntity($priority, $this->request->data);
            if ($this->Priorities->save($priority)) {
                $this->Flash->success(__('The priority has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The priority could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('priority'));
        $this->set('_serialize', ['priority']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Priority id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $priority = $this->Priorities->get($id);
        if ($this->Priorities->delete($priority)) {
            $this->Flash->success(__('The priority has been deleted.'));
        } else {
            $this->Flash->error(__('The priority could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
