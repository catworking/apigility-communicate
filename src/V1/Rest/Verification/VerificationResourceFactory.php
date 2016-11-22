<?php
namespace ApigilityCommunicate\V1\Rest\Verification;

class VerificationResourceFactory
{
    public function __invoke($services)
    {
        return new VerificationResource($services);
    }
}
