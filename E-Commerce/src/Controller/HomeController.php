<?php

namespace App\Controller;

use App\Entity\Admin\Messages2;
use App\Entity\User;
use App\Form\Admin\Messages2Type;
use App\Form\UserType;
use App\Repository\Admin\ProductRepository;
use App\Repository\Admin\SettingRepository;
use App\Repository\Admin\ImageRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SettingRepository $settingRepository, CategoryRepository $categoryRepository)
    {

        $data= $settingRepository->findAll();

        $em = $this->getDoctrine()->getManager();
        $sql= " SELECT * FROM product WHERE status = 'True' ORDER BY ID ASC LIMIT 4 " ;
        $statement = $em->getConnection()->prepare($sql);
        //$statement->bindValue('catid', $catid);
        $statement->execute();
        $sliders = $statement->fetchAll();

        $sql2= " SELECT * FROM product WHERE status = 'True' ORDER BY ID DESC LIMIT 8 " ;
        $statement2 = $em->getConnection()->prepare($sql2);
        //$statement->bindValue('catid', $catid);
        $statement2->execute();
        $lastproducts = $statement2->fetchAll();


        $cats= $this->categorytree();

        $cats[0] = '<ul id="menu-v">';

        return $this->render('home/index.html.twig', [
            'data' => $data,
            'cats' => $cats,
            'sliders' => $sliders,
            'lastproducts' => $lastproducts,
        ]);
    }

    public function categorytree ($parent = 0, $user_tree_array = ''){
        if(!is_array($user_tree_array)){
            $user_tree_array= array();
        }
        $em = $this->getDoctrine()->getManager();
        $sql= "SELECT * FROM category WHERE status='True' AND parentid=".$parent;
        $statement = $em->getConnection()->prepare($sql);
        //$statement->bindValue('pid', $parent);
        $statement->execute();
        $result = $statement->fetchAll();

        if(count($result) > 0){
            $user_tree_array[] = "<ul>";
            foreach($result as $row) {
                $user_tree_array[] = "<li> <a href='/category/".$row['id']."'>".$row['title']."</a>";
                $user_tree_array = $this->categorytree($row['id'], $user_tree_array);

            }
            $user_tree_array[]= "</li></ul>";
        }
        return $user_tree_array;

    }

    /**
     * @Route("/category/{catid}", name="category_products", methods="GET")
     */
    public function CategoryProducts ( $catid, CategoryRepository $categoryRepository )
    {
        $cats= $this->categorytree();
        $cats[0] = '<ul id="menu-v">';

        $data= $categoryRepository->findBy(
            ['id' => $catid]
        );
        //dump($data);



        $em = $this->getDoctrine()->getManager();
        $sql= ' SELECT * FROM product WHERE status = "True" AND category_id = :catid' ;
        $statement = $em->getConnection()->prepare($sql);
        $statement->bindValue('catid', $catid);
        $statement->execute();
        $products = $statement->fetchAll();
        //dump($result);
        //die();

        return $this->render('home/products.html.twig', [
            'data' => $data,
            'products' => $products,
            'cats' => $cats,
        ]);
    }



    /**
     * @Route("/product/{id}", name="product_detail", methods="GET")
     */
    public function ProductDetail ( $id, ProductRepository $productRepository,ImageRepository $imageRepository )
    {
        $data= $productRepository->findBy(
            ['id' => $id]
        );

        $image= $imageRepository->findBy(
            ['product_id' => $id]
        );

        $cats= $this->categorytree();
        $cats[0] = '<ul id="menu-v">';


        return $this->render('home/product_detail.html.twig', [
            'data' => $data,
            'cats' => $cats,
            'image' => $image,

        ]);
    }

        /**
     * @Route("/hakkimizda", name="hakkimizda")
     */
    public function hakkimizda (SettingRepository $settingRepository)
    {

        $data= $settingRepository->findAll();

        return $this->render('home/hakkimizda.html.twig', [
            'data' => $data,
        ]);
    }
    /**
     * @Route("/referanslar", name="referanslar")
     */
    public function referanslar (SettingRepository $settingRepository)
    {

        $data= $settingRepository->findAll();

        return $this->render('home/referanslar.html.twig', [
            'data' => $data,
        ]);
    }
    /**
     * @Route("/iletisim", name="iletisim", methods="POST|GET")
     */
    public function iletisim (SettingRepository $settingRepository, Request $request)
    {
        $messages2 = new Messages2();
        $form = $this->createForm(Messages2Type::class, $messages2);
        $form->handleRequest($request);

        $submittedToken = $request->request->get('token');

        if ($form->isSubmitted() ) {

            if ($this->isCsrfTokenValid('form-message', $submittedToken)) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($messages2);
                $messages2->setStatus("New");
                $em->flush();
                $this->addFlash('success', 'Mesajınız Başarıyla Gönderilmiştir.');
                return $this->redirectToRoute('iletisim');
            }
        }



        $data= $settingRepository->findAll();

        return $this->render('home/iletisim.html.twig', [
            'data' => $data,
            'messages2' => $messages2,
        ]);
    }

    /**
     * @Route("/newuser", name="new_user" , methods="GET|POST")
     */
    public function newuser (Request $request, UserRepository $userRepository):Response
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $submittedToken = $request->request->get('token');

        if ($this->isCsrfTokenValid('user-form', $submittedToken)) {
            if ($form->isSubmitted()) {

                $emaildata= $userRepository->findBy(
                    ['email' => $user->getEmail()]
                );

                if($emaildata==null  )
                {

                    $em = $this->getDoctrine()->getManager();
                    $user->setRoles("ROLE_USER");
                    $user->setStatus("True");
                    $em->persist($user);
                    $em->flush();
                    $this->addFlash('success', 'Üyelik İşlemi Başarıyla Gerçekleştirilmiştir. Giriş Yapabilirsiniz.');
                    return $this->redirectToRoute('app_login');
                }
                else{
                    $this->addFlash('error', $user->getEmail().'  Email Adresi Daha Önce Kullanılmış !');

                    //return $this->redirectToRoute('new_user');
                }
            }
        }

        return $this->render('home/newuser.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
