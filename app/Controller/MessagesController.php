<?php	
class MessagesController extends AppController
{
	public $helpers = array('Html', 'Form', 'Time', 'Paginator');
	public $components = array('Paginator');
	public $uses = array('User');

    public $paginate = array(
        'limit' => 8,
        'order' => array(
        	'Message.f_read' => 'asc',
            'Message.created' => 'desc'
        ),
        'recursive' => -1,
    );
	function index()
	{
		$this->Paginator->settings = $this->paginate;
		$messages = $this->Paginator->paginate('Message',array('user_id' => $this->Auth->user('id')));
		$this->set('messages', $messages);
	}

	function view($id = null)
	{
		$this->Message->markRead($id);

	}
}

?>