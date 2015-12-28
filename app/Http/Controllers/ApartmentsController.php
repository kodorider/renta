<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use App\Apartment;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;
use App\Http\Requests;
use Swagger\Annotations as SWG;
use Response;

class ApartmentsController extends Controller
{
    private $apartmentRepository;

    private $entityManager;

    /**
     * ApartmentsController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        $this->apartmentRepository = $entityManager->getRepository(Apartment::class);
    }
    
    public function index()
    {
       $apartments = $this->apartmentRepository->findBy(array('status' => false));

        $result = [];

        foreach($apartments as $apartment)
        {

            $result[] = [
                'id' => $apartment->getId(),
                'rooms' => $apartment->getRooms(),
                'floor' => $apartment->getFloor(),
                'address' => $apartment->getAddress(),
                'price' => $apartment->getPrice(),
                'note' => $apartment->getNote(),
                'status' => $apartment->getStatus(),
                'ownerId' => $apartment->getOwnerId(),
            ];
        }

        return Response::json($result, 201);
    }
}

