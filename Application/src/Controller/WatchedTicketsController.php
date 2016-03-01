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
      public function isAuthorized($user)
    {
        // All registered users can view
        if (in_array($this->request->action, ['add', 'delete'])) {
          return true;
        }
        return parent::isAuthorized($user);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $watchedTicket = $this->WatchedTickets->newEntity();
        if ($this->request->is('post')) {
            $watchedTicket = $this->WatchedTickets->patchEntity($watchedTicket, $this->request->data);
            if ($this->WatchedTickets->save($watchedTicket)) {
                $this->Flash->success(__('The ticket has been saved as a watched ticket.'));
                return $this->redirect(['controller' => 'Updates','action' => 'ticket', $id]);
            } else {
                $this->Flash->error(__('The watched ticket could not be saved. Please, try again.'));
            }
        }
        $users = $this->WatchedTickets->Users->find('list', ['limit' => 200]);
        $tickets = $this->WatchedTickets->Tickets->find('list', ['limit' => 200]);
        $this->set(compact('watchedTicket', 'users', 'tickets'));
        $this->set('_serialize', ['watchedTicket']);
        $this->set('id', $id);
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
            $this->Flash->success(__('The ticket has been removed from your watched tickets.'));
        } else {
            $this->Flash->error(__('The watched ticket could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Tickets','action' => 'watched', $this->request->session()->read('Auth.User.id')]);
    }

}
