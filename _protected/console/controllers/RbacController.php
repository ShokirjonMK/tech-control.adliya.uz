<?php
namespace console\controllers;

use yii\helpers\Console;
use yii\console\Controller;
use Yii;

/**
 * Creates base rbac authorization data for our application.
 * -----------------------------------------------------------------------------
 * Creates 6 roles:
 *
 * - theCreator : you, developer of this site (super admin)
 * - admin      : your direct clients, administrators of this site
 * - editor     : editor of this site
 * - support    : support staff
 * - premium    : premium member of this site
 * - member     : user of this site who has registered his account and can log in
 *
 * Creates 7 permissions:
 *
 * - usePremiumContent  : allows premium members to use premium content
 * - createArticle      : allows editor+ roles to create articles
 * - updateOwnArticle   : allows editor+ roles to update own articles
 * - updateArticle      : allows admin+ roles to update all articles
 * - deleteArticle      : allows admin+ roles to delete articles
 * - adminArticle       : allows admin+ roles to manage articles
 * - manageUsers        : allows admin+ roles to manage users (CRUD plus role assignment)
 *
 * Creates 1 rule:
 *
 * - AuthorRule : allows editor+ roles to update their own content
 */
class RbacController extends Controller
{
    /**
     * Initializes the RBAC authorization data.
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        //---------- RULES ----------//

        // add the rule
        $rule = new \common\rbac\rules\AuthorRule;
        $auth->add($rule);

        //---------- PERMISSIONS ----------//

           $controler1 = $auth->createPermission('UserController');
            $auth->add($controler1);


            $member = $auth->createRole('Student');
            $auth->add($member);
            $auth->addChild($member, $controler1);

            $member2 = $auth->createRole('Teacher');
            $auth->add($member2);
            $auth->addChild($member2, $controler1);

            $member3 = $auth->createRole('Zamdekan');
            $auth->add($member3);
            $auth->addChild($member3, $controler1);

            $member4 = $auth->createRole('Dekan');
            $auth->add($member4);
            $auth->addChild($member4, $controler1);

            $member5 = $auth->createRole('Mudir');
            $auth->add($member5);
            $auth->addChild($member5, $controler1);

            $member6 = $auth->createRole('Eduleader');
            $auth->add($member6);
            $auth->addChild($member6, $controler1);

            $member7 = $auth->createRole('Prorektor');
            $auth->add($member7);
            $auth->addChild($member7, $controler1);

            $member8 = $auth->createRole('Rektor');
            $auth->add($member8);
            $auth->addChild($member8, $controler1);

            
            $member9 = $auth->createRole('Admin');
            $auth->add($member9);
            $auth->addChild($member9, $controler1);

              

            $theCreator = $auth->createRole('theCreator');
            $theCreator->description = 'You!';
            $auth->add($theCreator); 
         
            $auth->addChild($theCreator, $member);
            $auth->addChild($theCreator, $member2);
            $auth->addChild($theCreator, $member3);
            $auth->addChild($theCreator, $member4);
            $auth->addChild($theCreator, $member5);
            $auth->addChild($theCreator, $member6);
            $auth->addChild($theCreator, $member7);
            $auth->addChild($theCreator, $member8);
            $auth->addChild($theCreator, $member9);
         


        if ($auth) 
        {
            $this->stdout("\nRbac authorization data are installed successfully.\n", Console::FG_GREEN);
        }
    }
}