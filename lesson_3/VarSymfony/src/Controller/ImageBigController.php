<?php

namespace App\Controller;

use App\Entity\ImagesBig;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageBigController extends HomePageController
{
    #[Route('/twoPage', name: 'image_big')]
    public function index(): Response
    {
        $photo = stripcslashes($_GET['photo']);

        $imageBigRepository = $this->getDoctrine()->getRepository(ImagesBig::class);
        $threeImages = $imageBigRepository->findBy(['viewCount' => 'ASC'], limit: 3);
        $imageBig = $imageBigRepository->findOneBy(['urlImgBig' => $photo]);

//    Подскажите, как правильно получить значение 'viewCount'
//    (при этом как отображать в твиге я зная).
//    Самостоятельно, я не смог найти.

        return $this->render('image_big/index.html.twig', [
            'title' => 'Домашнее задание 3 урока',
            'photo' => $photo,
            'threeImages' => $threeImages,
            'imageBig' => $imageBig,
        ]);
    }
}
