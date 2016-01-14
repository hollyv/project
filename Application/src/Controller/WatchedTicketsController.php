<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WatchedTickets Controller
 *
 * @property \App\Model\Table\WatchedTicketsTable $WatchedTickets
 */
class WatchedTicketsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Analysts', 'Tickets']
        ];
        $this->set('watchedTickets', $this->paginate($this->WatchedTickets));
        $this->set('_serialize', ['watchedTickets']);
    }

    /**
     * View method
     *
     * @param string|null $id Watched Ticket id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $watchedTicket = $this->WatchedTickets->get($id, [
            'contain' => ['Analysts', 'Tickets']
        ]);
        $this->set('watchedTicket', $watchedTicket);
        $this->set('_serialize', ['watchedTicket']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $watchedTicket = $this->WatchedTickets->newEntity();
        if ($this->request->is('post')) {
            $watchedTicket = $this->WatchedTickets->patchEntity($watchedTicket, $this->request->data);
            if ($this->WatchedTickets->save($watchedTicket)) {
                $this->Flash->success(__('The watched ticket has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The watched ticket could not be saved. Please, try again.'));
            }
        }
        $analysts = $this->WatchedTickets->Analysts->find('list', ['limit' => 200]);
        $tickets = $this->WatchedTickets->Tickets->find('list', ['limit' => 200]);
        $this->set(compact('watchedTicket', 'analysts', 'tickets'));
        $this->set('_serialize', ['watchedTicket']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Watched Ticket id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $watchedTicket = $this->WatchedTickets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $watchedTicket = $this->WatchedTickets->patchEntity($watchedTicket, $this->request->data);
            if ($this->WatchedTickets->save($watchedTicket)) {
                $this->Flash->success(__('The watched ticket has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The watched ticket could not be saved. Please, try again.'));
            }
        }
        $analysts = $this->WatchedTickets->Analysts->find('list', ['limit' => 200]);
        $tickets = $this->WatchedTickets->Tickets->find('list', ['limit' => 200]);
        $this->set(compact('watchedTicket', 'analysts', 'tickets'));
        $this->set('_serialize', ['watchedTicket']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Watched Ticket id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $watchedTicket = $this->WatchedTickets->get($id);
        if ($this->WatchedTickets->delete($watchedTicket)) {
            $this->Flash->success(__('The watched ticket has been deleted.'));
        } else {
            $this->Flash->error(__('The watched ticket could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
