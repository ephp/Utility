<?php

namespace Ephp\UtilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ephp\UtilityBundle\Entity\Seo\Seo;
use Ephp\UtilityBundle\Form\Seo\SeoType;

/**
 * Seo controller.
 *
 * @Route("/seo")
 */
class SeoController extends Controller {

    use Traits\BaseController;
    
    /**
     * Lists all Seo entities.
     *
     * @Route("/", name="admin_seo")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('EphpUtilityBundle:Seo\Seo')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Seo entity.
     *
     * @Route("/{id}/show", name="admin_seo_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EphpUtilityBundle:Seo\Seo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }
    
    /**
     * Finds and displays a Seo entity.
     *
     * @Route("/{id}/applica_a_tutti", name="admin_seo_all")
     * @Template()
     */
    public function allAction($id) {
        set_time_limit(3600);
        $em = $this->getDoctrine()->getEntityManager();
        $entity = new Seo();
        $entity = $em->getRepository('EphpUtilityBundle:Seo\Seo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seo entity.');
        }

        $_repo = $em->getRepository($entity->getEntityClass());
        $all = $_repo->findAll();
        
        foreach($all as $one) {
                $seo = new \Ephp\UtilityBundle\Seo\Seo($em);
                $one->setSeo($seo);
                $one->generateSeo($seo);
                $em->persist($one);
                $em->flush();
        }
        
        return $this->redirect($this->generateUrl('admin_seo'));
    }   
    
    /**
     * Finds and displays a Seo entity.
     *
     * @Route("/{id}/applica/da/{da}/a/{a}", name="admin_seo_n")
     * @Template()
     */
    public function nAction($id, $da, $a) {
        set_time_limit(3600);
        $em = $this->getEm();
        $entity = new Seo();
        $entity = $em->getRepository('EphpUtilityBundle:Seo\Seo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seo entity.');
        }

        $_repo = $em->getRepository($entity->getEntityClass());
        $all = $_repo->findBy(array(), array(), $a, $da);
        
        foreach($all as $one) {
                $seo = new \Ephp\UtilityBundle\Seo\Seo($em);
                $one->setSeo($seo);
                $one->generateSeo($seo);
                $em->persist($one);
                $em->flush();
        }
        
        return $this->redirect($this->generateUrl('admin_seo'));
    }
    
    /**
     * Displays a form to create a new Seo entity.
     *
     * @Route("/new", name="admin_seo_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Seo();
        $form = $this->createForm(new SeoType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Seo entity.
     *
     * @Route("/create", name="admin_seo_create")
     * @Method("post")
     * @Template("EphpUtilityBundle:Seo:new.html.twig")
     */
    public function createAction() {
        $entity = new Seo();
        $request = $this->getRequest();
        $form = $this->createForm(new SeoType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_seo'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Seo entity.
     *
     * @Route("/{id}/edit", name="admin_seo_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EphpUtilityBundle:Seo\Seo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seo entity.');
        }

        $editForm = $this->createForm(new SeoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $classe = $entity->getEntityClass();
        
        return array(
            'seo' => $entity,
            'entity' => new $classe(),
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Seo entity.
     *
     * @Route("/{id}/update", name="admin_seo_update")
     * @Method("post")
     * @Template("EphpUtilityBundle:Seo:edit.html.twig")
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EphpUtilityBundle:Seo\Seo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seo entity.');
        }

        $editForm = $this->createForm(new SeoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_seo'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Seo entity.
     *
     * @Route("/{id}/delete", name="admin_seo_delete")
     * @Method("post")
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('EphpUtilityBundle:Seo\Seo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Seo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_seo'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    /**
     * Lists all Seo entities.
     *
     * @Route("/help", name="admin_seo_genera_help")
     * @Template()
     */
    public function helpAction() {
        $classe = $this->getRequest()->get('classe');
        if(!class_exists($classe)) {
            echo "ko";
            exit;
        }
        $entity = new $classe();
        return array('entity' => $entity);
    }

}
