<?php

/*

	Bookworm plugin build by Ian Isted
	@ianisted

*/

namespace Craft;

class BookwormPlugin extends BasePlugin
{
    function getName()
    {
         return Craft::t('Bookworm');
    }

    function getVersion()
    {
        return '1.0';
    }

    function getDeveloper()
    {
        return 'Ian Isted';
    }

    function getDeveloperUrl()
    {
        return 'http://ianisted.co.uk';
    }
    
    protected function defineSettings()
    {
        return array(
            'goodreadsID' => array(AttributeType::String, 'required' => true, 'label' => 'Goodreads User ID', 'default' => Craft::t('')),
            'goodreadsAPIKey' => array(AttributeType::String, 'required' => false, 'label' => 'Goodreads API Key', 'default' => false),
            'showErrors' => array(AttributeType::Bool, 'required' => false, 'label' => 'Show errors', 'default' => false)
        );
    }
    
    
    public function getSettingsHtml()
    {
       return craft()->templates->render('Bookworm/settings', array(
           'settings' => $this->getSettings()
       ));
		}
		
}
?>