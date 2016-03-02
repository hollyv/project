<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
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

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null){
      //editing ticket details to update the status to closed.
      //once done, it flashes success and redirects user to the previous page.
      $watchedTicketsTable = TableRegistry::get('Watched_Tickets');
      $watchedTicket = $watchedTicketsTable->newEntity();
      $watchedTicket->ticket_id = $id;
      $watchedTicket->analyst_id = $this->request->session()->read('Auth.User.id');
       if ($this->WatchedTickets->save($watchedTicket)) {
                $this->Flash->success(__('The ticket has been added as a watched ticket.'));
                return $this->redirect(['controller' => 'Updates','action' => 'ticket', $id]);
            } else {
                $this->Flash->error(__('The watched ticket could not be saved. Please, try again.'));
            }
        }
      }


