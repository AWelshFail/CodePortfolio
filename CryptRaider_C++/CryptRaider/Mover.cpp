// Fill out your copyright notice in the Description page of Project Settings.

#include "Mover.h"
#include "Math/UnrealMathUtility.h"

// Sets default values for this component's properties
UMover::UMover()
{
	// Set this component to be initialized when the game starts, and to be ticked every frame.  You can turn these features
	// off to improve performance if you don't need them.
	PrimaryComponentTick.bCanEverTick = true;

	// ...
}

// Called when the game starts
void UMover::BeginPlay()
{
	Super::BeginPlay();

	OriginalLocation = GetOwner()->GetActorLocation();
	// ...
}

// Called every frame
void UMover::TickComponent(float DeltaTime, ELevelTick TickType, FActorComponentTickFunction *ThisTickFunction)
{
	Super::TickComponent(DeltaTime, TickType, ThisTickFunction);
	FVector TargetLocation = OriginalLocation;
	if (ShouldMove == true)
	{
		TargetLocation = OriginalLocation + MoveOffset;
	}
	FVector CurrentLocation = GetOwner()->GetActorLocation();
		
	float Speed = MoveOffset.Length() / MoveTime;

	FVector NewLocation = FMath::VInterpConstantTo(CurrentLocation, TargetLocation, DeltaTime, Speed);
	GetOwner()->SetActorLocation(NewLocation);
	
	

	// 	AActor *Owner = GetOwner();
	// 	FString Name = Owner->GetActorNameOrLabel();
	// 	FVector OwnerLocation = Owner->GetActorLocation();
	// 	FString OwnerLocationString = OwnerLocation.ToCompactString();
	// 	UE_LOG(LogTemp, Display, TEXT("Owner is %s with location %s"), *Name, *OwnerLocationString);

	// 	// float MyFloat = 5;
	// 	// float* YourFloat = &MyFloat;
	// 	// float FloatValue = *YourFloat; //Dereference by assigning the pointer * before the varible however assigning it to a variable (FloatVaule) is a waste of memory instead use the pointer
	// 	// UE_LOG(LogTemp, Display, TEXT("Float value is %f"), *YourFloat);

	// 	// ...
}

void UMover::SetShouldMove(bool NewShouldMove)
{
	ShouldMove = NewShouldMove;
}