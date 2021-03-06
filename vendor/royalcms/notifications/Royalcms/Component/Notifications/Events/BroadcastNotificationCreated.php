<?php namespace Royalcms\Component\Notifications\Events;

use Royalcms\Component\Queue\SerializesModels;
use Royalcms\Component\Notifications\Notification;
use Royalcms\Component\Broadcasting\PrivateChannel;
use Royalcms\Component\Contracts\Broadcasting\ShouldBroadcast;

class BroadcastNotificationCreated implements ShouldBroadcast
{
     use SerializesModels;

    /**
     * The notifiable entity who received the notification.
     *
     * @var mixed
     */
    public $notifiable;

    /**
     * The notification instance.
     *
     * @var \Royalcms\Component\Notifications\Notification
     */
    public $notification;

    /**
     * The notification data.
     *
     * @var array
     */
    public $data = array();

    /**
     * Create a new event instance.
     *
     * @param  mixed  $notifiable
     * @param  \Royalcms\Component\Notifications\Notification  $notification
     * @param  array  $data
     * @return void
     */
    public function __construct($notifiable, $notification, $data)
    {
        $this->data = $data;
        $this->notifiable = $notifiable;
        $this->notification = $notification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return array(new PrivateChannel($this->channelName()));
    }

    /**
     * Get the data that should be sent with the broadcasted event.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return array_merge($this->data, array(
            'id' => $this->notification->id,
            'type' => get_class($this->notification),
        ));
    }

    /**
     * Get the broadcast channel name for the event.
     *
     * @return string
     */
    protected function channelName()
    {
        $class = str_replace('\\', '.', get_class($this->notifiable));

        return $class.'.'.$this->notifiable->getKey();
    }
}
