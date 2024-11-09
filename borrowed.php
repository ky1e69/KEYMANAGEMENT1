<!DOCTYPE html>

<head>
    <link rel="icon" type="image/x-icon" href="/pics/favicon.ico.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title> Borrowed Keys</title>
    <link rel="stylesheet" href="1st_flr.css">
</head> 
<body>
    
    <div class="Home Page">
        <div class="navbar">
            <ul>
                <li> <a href="1st_flr.html">   FIRST FLOOR  <i class="fa fa-key"></i>            </a></li>
                <li> <a href="3rd_flr.html">   SECOND FLOOR <i class="fa fa-key"> </i>        </a></li>
                <li> <a href="4th_flr.html"> THIRD FLOOR  <i class="fa fa-key"></i>      </a></li>
    
            </ul>
        </div>
        
    </div>

    <h1 class="title"> Choose what key you would like to return.</h1>

    <section class="slider-container">
      
        <div class="slider-images">
            <div class="slider-img" onclick="selectKey(this)">
                <img src="Images/key_1.png" alt="1">
                <div class="details">
                    <h1>EN CME 101</h1>
                </div>
            </div>
            <div class="slider-img" onclick="selectKey(this)">
                <img src="Images/key_1.png" alt="2">
                <div class="details">
                    <h1>EN CME 102</h1>
                </div>
            </div>
            <div class="slider-img" onclick="selectKey(this)">
                <img src="Images/key_1.png" alt="3">
                <div class="details">
                    <h1>ELECTRO LAB</h1>
                </div>
            </div>
            <div class="slider-img" onclick="selectKey(this)">
                <img src="Images/key_1.png" alt="3">
                <div class="details">
                    <h1>COM LAB 1</h1>
                </div>
            </div>

            <div class="slider-img" onclick="selectKey(this)">
                <img src="Images/key_1.png" alt="3">
                <div class="details">
                    <h1>COM LAB 2</h1>
                </div>
            </div>
            
            <!-- Add more slider-img elements as needed -->
        </div>
    
        
    </section>

    <button id="return-btn" onclick="resetSelection()">Return</button>
    
    <script>

        // Function to highlight the clicked key
function selectKey(element) {
    // Remove the 'selected' class from all keys
    let keys = document.querySelectorAll('.slider-img');
    keys.forEach(function(key) {
        key.classList.remove('selected');
    });

    // Add 'selected' class to the clicked key
    element.classList.add('selected');
}

// Function to reset the selected key
function resetSelection() {
    // Remove the 'selected' class from all keys
    let keys = document.querySelectorAll('.slider-img');
    keys.forEach(function(key) {
        key.classList.remove('selected');
    });
}

    </script>

</body>
</html>