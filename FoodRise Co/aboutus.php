<?php
include 'mysqli_connect.php';
include 'header.php';
//
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - FoodRise Co.</title>
    <link rel="stylesheet" href="style.css">
    <style> 
        body{
            margin:0;
        }
        
        .impact {
            text-align: center;
            
            border-bottom: 1px solid #333;
        }
       
        
        .about-title {
            font-family:'Lexend Deca' ;
            font-size: 52px;
            font-weight: 900;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
            margin: 50 200 20 200;
        }
        
       
        
        
        .cards {
            display: flex;
            justify-content: space-around;
            text-align: center;
            margin-top: 50px;
            margin-bottom: 50px;
            gap: 50px;
        }
        
        .cards .stat {
            background-color: #FFF;
            padding: 20px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 30%;
            transition: transform 0.5s ease;
            animation: fadeInCard 3s forwards;
        }
        
        .cards .stat h1 {
            font-size: 36;
            font-weight: 900;
            color: #333;
            margin-top: 15px;
            margin-bottom: 10px;
        }
        
        .cards .stat h3 {
            font-size: 16;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        
        .cards .stat:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }
        
        .about-container{
            margin: 50 200 20 200;
        }

        
        /* General Section Styling */
.about-section {
  display: flex;
  flex-direction: column;
  align-items: start;
  margin: 0 auto;
  max-width: 1200px;
}

/* Section Titles */
.section-title {
  color: #000;
  font: 800 56px/1.3 'Lexend Deca', sans-serif;
  margin-left: 14px;
}

.divider {
  margin-top: 43px;
  width: 100%;
  height: 1px;
  border: 1px solid #000;
}

/* Subsection Titles */
.subsection-title {
  color: #000;
  margin-top: 49px;
  font: 36px/1.3 'Lexend Deca', sans-serif;
}

/* Content Wrapper */
.content-wrapper {
  margin-top: 30px;
  display: flex;
  width: 100%;
}

.content-grid {
  display: flex;
  gap: 100px;
}

.text-column {
  width: 70%;
  font: 200 26px/34px 'Lexend Deca', sans-serif;
}

.image-column {
  width: 20%;
  height: 20%;
}

.feature-image {
  width: 100%;
  object-fit: contain;
}

/* Mission Section */
.mission {
    border-bottom: 1px solid #333;
}

.mission-title {
  text-align: center;
  margin: 50 0 50 0;
  font: 700 36px/1.3 'Lexend Deca', sans-serif;
}

.mission-item {
  text-align: left;
  margin: 20px auto;
  padding-bottom:20px;
}

.mission-item h3{
  font-size: 30px;
  margin: 5 0 5 0;
}

.mission-heading {
  font-size: 36px;
  font-weight: 500;
}

.mission-description{
  font-size: 18px;
  font-weight: 100;
  line-height: 1.5;
}

.impact-description {
  font-size: 22px;
  font-weight: 100;
  line-height: 1.8;
  padding-bottom:20px;
}

/* Statistics */
.stats-container {
  margin-top: 62px;
}

.stats-grid {
  display: flex;
  gap: 20px;
}

.stat-card {
  flex: 1;
  background: #fff;
  box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
  padding: 49px;
  border-radius: 20px;
  text-align: center;
  font-family: 'Lexend Deca', sans-serif;
}

.stat-number {
  font-size: 60px;
  margin-top: 20px;
}

/* Testimonials */
.testimonials-section {
  padding-bottom: 20px;
  border-bottom: 1px solid #333;
}

.testimonial-grid {
  display: flex;
  gap: 20px;
  justify-content: space-between; /* Ensure space between content */
  align-items: center;
}

.testimonial-content {
  flex: 1;
  font: 300 24px/1.3 'Lexend Deca', sans-serif;
}

.testimonial-text {
  font-size: 36px;
  font-weight: 600;
  margin-top: 20px;
}

.testimonial-image {
  width: 100%;
  max-width: 500px;
  height: auto;
  border-radius: 20px;
  object-fit: cover; 
}

.image-column {
  flex: 0.5; /* Adjust the image column to take half space */
}

.who-we-are{
    border-bottom: 1px solid #333;
            padding-bottom: 10px;
}

.zerohunger-image{
width: 100%;
}

.zero-hunger{
display:flex;
padding: 20 0 10 0;
width: 100%;
justify-content: center; /* Ensure space between content */
  align-items: center;
}

/* Responsive Design */
@media (max-width: 991px) {
  .content-grid, .stats-grid, .testimonial-grid {
    flex-direction: column;
    gap: 0;
  }

  .feature-image, .testimonial-image {
    margin: 20px 0;
  }
}
        
        
    </style>
</head>
<body>

	<div class="about-title">About FoodRise Co.</div>
	
    <div class="about-container">
   	    <!-- Who We Are -->
   	    <div class="who-we-are">
   	    	<h2 class="subsection-title">Who we are?</h2>
              <div class="content-wrapper">
                <div class="content-grid">
                  <!-- Text Content -->
                  <div class="text-column">
                    <p class="intro-text">
                      Founded in 2020, FoodRise Co. was born out of a deep commitment to address food insecurity and make a meaningful contribution to the global fight against hunger. From our humble beginnings, we have grown into a passionate community of volunteers, donors, and partners working together to ensure that everyone has access to nutritious food.
                    </p>
                  </div>
                  <!-- Image -->
                  <div class="image-column">
                    <img src="images/who-we-are.png" alt="FoodRise Co. community impact" class="feature-image" />
                  </div>
                </div>
              </div>
          </div>
          
          <div class="mission">
          		<h2 class="mission-title">Our Mission and Goals</h2>
  
              <div class="mission-item">
                <h3 class="mission-heading">Reduce Food Insecurity</h3>
                <p class="mission-description">
                  Distribute food to underserved populations efficiently and consistently.
                </p>
              </div>
            
              <div class="mission-item">
                <h3 class="mission-heading">Promote Sustainability</h3>
                <p class="mission-description">
                  Reducing food waste by rescuing surplus food from local farms and businesses and redirecting it to those in need.
                </p>
              </div>
            
              <div class="mission-item">
                <h3 class="mission-heading">Inspire Volunteering</h3>
                <p class="mission-description">
                  Empower individuals to give back through volunteer opportunities, helping them make a lasting impact in their communities.
                </p>
              </div>
          </div>
          
          
          <div class="impact">
				<h2 class="subsection-title">Where we are now?</h2>
		
        		<div class="cards">
        		
        			<div class="stat">
                        <h3>Meals Donated</h3>
                        <h1>8,000</h1>
                        <p>servings</p>
                    </div>
                    
                    <div class="stat">
                        <h3>Volunteers Engaged</h3>
                        <h1>8,000</h1>
                        <p>persons</p>
                    </div>
                    
                    <div class="stat">
                        <h3>Food Waste Reduced</h3>
                        <h1>200</h1>
                        <p>kilograms</p>
                    </div>
        		
        		</div>
        		
        		<p class="impact-description">
                  Today, we are proud of the progress we've made, but we know there is still much to do. With the support of our community, 
                  we have provided thousands of meals to families in need and continue to build relationships 
                  that strengthen our food distribution network.
                </p>
		</div>
		
		<div class="testimonials"> <div class="testimonials-section">
		<div class="testimonial-grid">
      <!-- Feedback -->
          <div class="testimonial-content">
            <h3 class="subsection-title">Testimonials</h3>
            <p class="mission-description">
                  Clients' Feedback
                </p>
            <p class="testimonial-text">
              FoodRise Co. has truly made a difference in the community.<br/>
              Their dedication to empowering farmers and promoting sustainable food systems is commendable.
            </p>
          </div>
          <!-- Image -->
          <div class="image-column">
            <img src="images/testimonial.png" class="testimonial-image" />
          </div>
    </div>
		</div> </div>
          
     <div class="zero-hunger"><img src="images/zerohunger.png" class="zerohunger-image" /></div>   
          
    </div>




 
    
 

	
	
	
	
	
    
    
<?php
    include 'footer.php';
?>
</body>
</html>
