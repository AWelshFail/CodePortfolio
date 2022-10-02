class SharkBullet
{
  int x;
  int y;
  
  
  int speed=-2;
  
  
  
  
  SharkBullet()
  {
       
  }
  
  
  void StartLocation(int startX, int startY)
  { 
    
      
     
      x = startX;
      y = startY;
    
  }
  
  void update()
  {
    render();
    move();
  }
   
  void render()
  {
   noFill();
   ellipse(x, y, 10, 10); 
   
  }
  
  void move()
  {
    if (y > -10){
    y = y + speed;
    sharkFire = true;
    }
    else{
      sharkFire = false;
    }
  }
  
    //dectects when the bullet has hit the player
    boolean boatCrash()
    {
    color detectedColour;
    for (int i=x-10; i<x + 20; i++)
    {

      detectedColour = get(i, y);
      //println(detectedColour);

      if (detectedColour == BOAT) {

        return true;
      }
    }
    return false;
  }
  
}