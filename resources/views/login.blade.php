<html>
<head>
    <link rel="stylesheet" href="{{'/style2.css'}}">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = [
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVC7mu5KgjWTEGHEIsowS51o5Mc0-Pt2AbCQ&s',
                'https://wallpapercave.com/wp/Z0kmvgB.jpg',
                'https://static.vecteezy.com/system/resources/thumbnails/023/321/451/small_2x/abstract-weather-concept-rain-and-lightning-on-black-umbrella-on-defocused-background-generative-ai-photo.jpg',
                'https://static.vecteezy.com/system/resources/thumbnails/029/771/813/small_2x/epicgraphy-shot-of-rainy-season-background-enjoying-nature-rainfall-and-happy-life-concept-generative-ai-free-photo.jpeg',
            ];
            let currentIndex = 0;

            document.body.addEventListener('click', function() {
                currentIndex = (currentIndex + 1) % images.length; // Cycle through the images
                document.body.style.backgroundImage = `url('${images[currentIndex]}')`;
                document.body.style.backgroundRepeat = 'no-repeat'; // Prevent repeating
                document.body.style.backgroundSize = 'cover'; // Cover the entire body
                document.body.style.backgroundPosition = 'center'; // Center the image
            });
        });
    </script>
</head>
<body id="body">
    
    <div class="main-div2">
        <div class="flip-container">
            <div class="flipper">
                    <div class="front">
                        <form id="front-form">
                            <div class="profile-img">
                                <img class="profile-img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpLL0Vh-R5m55H5pVonZTdLyI4_XXH6EY3DdRXNvA-4CHcze117uZ59iXPTwsI1anZPnY&usqp=CAU" alt="">
                            </div>
                            <div class="container">
                                <label class="labels" for="">Email:</label>
                                <input class="inputs" type="text">

                                <label class="labels" for="">Password:</label>
                                <input class="inputs" type="password">

                                <button class="btn-login">
                                    Log in
                                </button>

                                <p><a class="link-login" href="https://google.com">Forgot your password? </a>|<a type="button" onclick="flip()"> Sign up</a></p>
                            </div> 
                        </form>
                    </div>
                    <div class="back">
                        <form id="back-form">
                            <div class="profile-img">
                                <img class="profile-img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpLL0Vh-R5m55H5pVonZTdLyI4_XXH6EY3DdRXNvA-4CHcze117uZ59iXPTwsI1anZPnY&usqp=CAU" alt="">
                            </div>
                            <div class="container">
                                <label class="labels" for="">Name:</label>
                                <input class="inputs" type="text">

                                <label for="" class="labels">Email:</label>
                                <input type="text" class="inputs">

                                <label for="" class="labels">Password:</label>
                                <input type="password" class="inputs">

                                <label for="" class="labels">Confirm Password:</label>
                                <input type="password" class="inputs">

                                <button class="btn-login">
                                    Sign up
                                </button>

                            </div>
                            <div>
                                <a type="button" onclick="flip()">Login</a>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>

    <script>
        function flip() {
            const flipper = document.querySelector('.flipper');
            flipper.style.transform = flipper.style.transform === 'rotateY(180deg)' ? 'rotateY(0deg)' : 'rotateY(180deg)';
        }
    </script>
        
    </div>

</body>
</html>
