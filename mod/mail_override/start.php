<?php

    function mail_override_init() 
    {
        register_notification_handler('email', 'mail_override_notify_handler');
    }
    
    function mail_override_notify_handler(ElggEntity $from, ElggUser $to, $subject, $message, array $params = NULL) 
    {
        $user_guid = get_plugin_setting('send_user', 'mail_override');
        if (!$user_guid) {
            $user_guid = 2;
        }
        
        $admin = get_entity($user_guid);
        
        $subject = "To: " . $to->name . " - " . $subject;
        email_notify_handler($from, $admin, $subject, $message, $params);
    }
    
    
    register_elgg_event_handler('init','system','mail_override_init');       
?>
