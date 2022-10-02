class Boat {
  
  int x;
  int y=100;
  
  //constructor
  Boat(int x){
    this.x = x;
  }
  
  void update()
  {
    render();
  }
  
  void render() {
    //boat
    fill(BOAT);
    quad(x-50, y-25, x+50, y-25, x+25, y, x-25, y);
    rect(x, y-70, 2, 45);
    fill(255);
    triangle(x-40, y-40, x, y-70, x, y-40);
    //fisher
    rect(x+25, y-40, 10, 15);
    ellipse(x+30, y-45, 10, 10);
    //fishing line
    line(x+35, y-35, x+60, y-55);
    line(x+60, y-55, x+60, y-50);
    rect(x+59, y-50, 2, 3);
    
    
  }
  
  
}