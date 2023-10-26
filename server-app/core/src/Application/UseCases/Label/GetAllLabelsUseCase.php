<?php
declare(strict_types=1);
namespace CoreKanban\Application\UseCases\Label;

use CoreKanban\Application\Contracts\UseCases\Label\GetAllLabelsUseCaseInterface;
use CoreKanban\Application\DTO\Responses\Label\LabelDTO;
use CoreKanban\Domain\Contracts\Repositories\LabelRepositoryInterface;

class GetAllLabelsUseCase implements GetAllLabelsUseCaseInterface
{
    public function __construct(
        private LabelRepositoryInterface $labelRepository
    ) {}

    public function execute() : array
    {
        return LabelDTO::fromArray(
            $this->labelRepository->getAllLabels()
        );
    }
}