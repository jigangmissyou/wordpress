<?php

#main config
require_once(get_template_directory() . "/core/config.php");
require_once(get_template_directory() . "/core/aq_resizer.php");
require_once(get_template_directory() . "/core/page-settings.php");
require_once(get_template_directory() . "/core/theme-customizer.php");
#require_once(get_template_directory() . "/core/custom-header.php");

#classes
require_once(get_template_directory() . "/core/classes/menu-walker.php");

#all registration
require_once(get_template_directory() . "/core/registrator/css-js.php");
require_once(get_template_directory() . "/core/registrator/ajax-handlers.php");
require_once(get_template_directory() . "/core/registrator/sidebars.php");
require_once(get_template_directory() . "/core/registrator/fonts.php");
require_once(get_template_directory() . "/core/registrator/misc.php");

#widgets
require_once(get_template_directory() . "/core/widgets/flickr.php");
require_once(get_template_directory() . "/core/widgets/posts.php");

#TGM init
require_once(get_template_directory() . "/core/tgm/gt3-tgm.php");

require_once(get_template_directory() . "/core/updates-notifier.php");