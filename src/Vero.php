<?php

  namespace Vero;

  class Vero {

    private $client;

    public function __construct($auth_token, $development_mode = false) {
      if (!$auth_token)
        throw new \Exception("VeroClient auth_token parameter is required");

      $this->client = new Client($auth_token, $development_mode);
    }

    public function identify($user_id, $email = null, $data = array()) {
      if (!$user_id)
        throw new \Exception("Vero::Identify requires a user id");

      return $this->client->identify($user_id, $email, $data);
    }

    public function reidentify($user_id, $new_user_id) {
      if (!$user_id || !$new_user_id)
        throw new \Exception("Vero::Identify requires a user id AND a new user id");

      return $this->client->reidentify($user_id, $new_user_id);
    }

    public function update($user_id, $changes = array()) {
      if (!$user_id)
        throw new \Exception("Vero::Update requires a user id");

      if ($changes == array())
        throw new \Exception("Vero::Update requires changes param");

      return $this->client->update($user_id, $changes);
    }

    public function tags($user_id, $add = array(), $remove = array()) {
      if (!$user_id)
        throw new \Exception("Vero::Update requires a user id");

      if ($add == array() && $remove == array())
        throw new \Exception("Vero::Update requires either add or remove param");

      return $this->client->tags($user_id, $add, $remove);
    }

    public function unsubscribe($user_id) {
      if (!$user_id)
        throw new \Exception("Vero::Update requires a user id");

      return $this->client->unsubscribe($user_id);
    }

    public function resubscribe($user_id) {
      if (!$user_id)
        throw new Exception("Vero::Resubscribe requires a user id");

      return $this->client->resubscribe($user_id);
    }

    public function track($event_name, $identity = array(), $data = array(), $extras = array()) {
      if (!$event_name)
        throw new \Exception("Vero::Update requires an event name");
      if (($identity == array()) || ((gettype($identity) == 'array') && (!$identity['id'])))
        throw new \Exception("Vero::Update requires an identity profile with at least an id property");

      return $this->client->track($event_name, $identity, $data, $extras);
    }

  }

?>
