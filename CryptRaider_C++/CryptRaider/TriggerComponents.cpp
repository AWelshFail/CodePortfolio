// Fill out your copyright notice in the Description page of Project Settings.

#include "TriggerComponents.h"

UTriggerComponents::UTriggerComponents()
{
    // Set this component to be initialized when the game starts, and to be ticked every frame.  You can turn these features
    // off to improve performance if you don't need them.
    PrimaryComponentTick.bCanEverTick = true;

    // ...
}

void UTriggerComponents::BeginPlay()
{
    Super::BeginPlay();

    // ...
}

void UTriggerComponents::TickComponent(float DeltaTime, ELevelTick TickType, FActorComponentTickFunction *ThisTickFunction)
{
    Super::TickComponent(DeltaTime, TickType, ThisTickFunction);

    AActor *Actor = GetAcceptableActor();
    if (Actor != nullptr)
    {
        UPrimitiveComponent* Component = Cast<UPrimitiveComponent>(Actor->GetRootComponent());
        if(Component != nullptr)
        {
            Component->SetSimulatePhysics(false);
        }
         Actor->AttachToComponent(this, FAttachmentTransformRules::KeepWorldTransform);
        Mover->SetShouldMove(true);
        
    }
    else
    {
        
        Mover->SetShouldMove(false);
        UE_LOG(LogTemp, Display, TEXT("lock"));
    }
}

void UTriggerComponents::SetMover(UMover *NewMover)
{
    Mover = NewMover;
}

AActor *UTriggerComponents::GetAcceptableActor() const
{
    TArray<AActor *> Actors;
    GetOverlappingActors(Actors);

    for (AActor *Actor : Actors)
    {
        if (Actor->ActorHasTag(AcceptableActorTag) && !Actor->ActorHasTag("Grabbed"))
        {
            return Actor;
        }
    }

    return nullptr;
}