<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Annotations\AnnotationRegistry; 
use phpDocumentor\Reflection\DockBLock\Description;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

 /**
 * Require ROLE_ADMIN for *every* controller method in this class.  *
 * @IsGranted("ROLE_ADMIN")
  */

class AdminController extends AbstractController
{
    
      /**
     * @Route("/admin", name="admin")
     */
    public function adminIndex()
    {

        return $this->render('admin/index.html.twig');
        
    }
    






}
