<?php

namespace steamcms\forum_rules\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{
    /** @var \phpbb\config\config */
    protected $config;

    /** @var \phpbb\config\db_text */
    protected $config_text;

    /** @var \phpbb\template\template */
    protected $template;

    /** @var \phpbb\textformatter\renderer_interface */
    protected $renderer;

    public function __construct(
        \phpbb\config\config $config,
        \phpbb\config\db_text $config_text,
        \phpbb\template\template $template,
        \phpbb\textformatter\renderer_interface $renderer
    )
    {
        $this->config = $config;
        $this->config_text = $config_text;
        $this->template = $template;
        $this->renderer = $renderer;
    }

    public static function getSubscribedEvents()
    {
        return [
            'core.ucp_register_agreement_modify_template_data' => 'modify_agreement',
        ];
    }

    public function modify_agreement($event)
    {
        if (!$this->config['steamcms_forum_rules_enabled'])
        {
            return;
        }

        $rules_text = $this->config_text->get('steamcms_forum_rules_text');

        if (empty($rules_text))
        {
            return;
        }

        $rendered = $this->renderer->render($rules_text);

        $this->template->assign_var('STEAMCMS_FORUM_RULES', $rendered);
    }
}
