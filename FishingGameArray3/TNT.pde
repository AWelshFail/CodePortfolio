class TNT
{
  
  int x;
  int y = 50;
  int speed = 0;
  
  boolean firing;
  boolean returning;
  
  TNT(){
    firing = false;
    returning = false;
  }
 
  void startLocation(int startX, int startY)
  {
    if (firing == false && returning == false)
    {
    firing = true;
    returning =false;
    x = startX;
    y = startY;
    }
  }
  
  void update(){
    
    render();
    move();
  }
  
  void move(){
    if (y < height && firing == true){
      speed = 10;
      y = y + speed;
  }else{ 
     firing = false;
     speed = -10;
     y= y+speed;
     returning = true;
    }
    

     
    if (y == 50 || y<0){
      x = -40;
      speed = 0;
      returning = false;   
    }
    

    
  }
  
  
  
  void render(){
    fill(TNT1);
    noStroke();
    rect(x, y, 5, 5);
    stroke(0);
  }
}