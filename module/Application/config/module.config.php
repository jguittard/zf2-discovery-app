<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'status' => array(
            	'type' => 'Segment',
            	'options' => array(
	            	'route' => '/status[/:action][/:id]',
            		'defaults' => array(
	            		'controller' => 'Application\Controller\Status',
	            		'action' => 'index'
	            	),
	            	'constraints' => array(
	            		'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
	            		'id' => '[0-9]*'
	            	),
	            ),
            )
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'factories' => array(
        	'navigation.top' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        	'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        	'Application\Model\StatusTable' => 'Application\Model\StatusTableFactory',
        	'Application\Model\ResultSet' => 'Application\Model\ResultSetFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Status' => 'Application\Controller\StatusController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helper_config' => array(
	    'flashmessenger' => array(
	        'message_open_format'      => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul><li>',
	        'message_close_string'     => '</li></ul></div>',
	        'message_separator_string' => '</li><li>'
	    )
	),
    'navigation' => array(
    	'default' => array(
	    	array(
	    		'label' => 'Home',
	    		'route' => 'home',
	    	),
	    	array(
	    		'label' => 'Status',
	    		'route' => 'status',
	    	),
	    ),
    ),
    'form_elements' => array(
    	'invokables' => array(
	    	'form.status' => 'Application\Form\Status',
	    ),
    ),
    'db' => array(
    	'driver' => 'Pdo',
    	'dsn' => 'sqlite:' . getcwd() . '/data/db/status.db',
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
