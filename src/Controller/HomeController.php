<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller {

	/**
	 * @var EntityManagerInterface
	 */
	private $entityManager;
	/**
	 * @var SerializerInterface
	 */
	private $serializer;

	public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer) {
		$this->entityManager = $entityManager;
		$this->serializer = $serializer;
	}

	/**
	 * @Route("/home")
	 */
	public function indexAction() {
		$user = $this->entityManager->getRepository(User::class)->findOneBy(['name' => 'John']);
		$post = $this->entityManager->getRepository(Post::class)->findOneBy(['name' => 'Post 2']);

		// simulate submitted JSON
		$json = '
		{
			"id": ' . $user->getId() . ',
			"name": "John",
			"posts": [
				{
					"id": ' . $post->getId() . ',
					"name": "Post 2"
				}
			]
		}';

		// deserialize into existing user with 1 post (Post 2)
		$deserializedUser = $this->serializer->deserialize($json, User::class, 'json');

		// I would expect the merge to remove Post 1 from the database
		$this->entityManager->merge($deserializedUser);
		$this->entityManager->flush();

		// notice how Post 1 still exists (the linking entry in users_posts) is correctly removed though

		return $this->render('home.html.twig', ['user' => $deserializedUser]);
	}
}
