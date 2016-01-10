<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Analysts Controller
 *
 * @property \App\Model\Table\AnalystsTable $Analysts
 */
class AnalystsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('analysts', $this->paginate($this->Analysts));
        $this->set('_serialize', ['analysts']);
    }

    /**
     * View method
     *
     * @param string|null $id Analyst id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $analyst = $this->Analysts->get($id, [
            'contain' => ['Tickets', 'Updates']
        ]);
        $this->set('analyst', $analyst);
        $this->set('_serialize', ['analyst']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $analyst = $this->Analysts->newEntity();
        if ($this->request->is('post')) {
            $analyst = $this->Analysts->patchEntity($analyst, $this->request->data);
            if ($this->Analysts->save($analyst)) {
                $this->Flash->success(__('The analyst has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The analyst could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('analyst'));
        $this->set('_serialize', ['analyst']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Analyst id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $analyst = $this->Analysts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $analyst = $this->Analysts->patchEntity($analyst, $this->request->data);
            if ($this->Analysts->save($analyst)) {
                $this->Flash->success(__('The analyst has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The analyst could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('analyst'));
        $this->set('_serialize', ['analyst']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Analyst id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $analyst = $this->Analysts->get($id);
        if ($this->Analysts->delete($analyst)) {
            $this->Flash->success(__('The analyst has been deleted.'));
        } else {
            $this->Flash->error(__('The analyst could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
