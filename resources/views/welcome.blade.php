<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Golden Bean | Uganda Coffee</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|dancing-script:700|playfair-display:400,500" rel="stylesheet" />
        
        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            :root {
                --coffee-uganda-dark: #4B371C;  /* Rich Ugandan soil brown */
                --coffee-uganda-medium: #8B5A2B; /* Roasted Ugandan coffee */
                --coffee-uganda-light: #D2B48C;  /* Light roast tones */
                --coffee-uganda-cream: #FFF8E1;  /* Creamy Ugandan arabica */
                --coffee-uganda-gold: #D4AF37;   /* Golden coffee blossoms */
                --coffee-uganda-green: #5A7247;  /* Uganda's lush greenery */
            }
            
            body {
                background-color: var(--coffee-uganda-cream);
                color: var(--coffee-uganda-dark);
                font-family: 'Playfair Display', serif;
                min-height: 100vh;
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                background-image: url('https://images.unsplash.com/photo-1602524818607-f2b046a5d5a0?q=80&w=1000');
                background-size: cover;
                background-position: center;
                background-blend-mode: overlay;
                background-color: rgba(249, 245, 240, 0.9);
            }
            
            .coffee-wrapper {
                width: 100%;
                max-width: 1200px;
                padding: 2rem;
                display: flex;
                justify-content: center;
            }
            
            .coffee-container {
                width: 100%;
                max-width: 800px;
                background: rgba(255, 255, 255, 0.95);
                border-radius: 20px;
                box-shadow: 0 10px 30px rgba(75, 55, 28, 0.2);
                padding: 4rem;
                position: relative;
                overflow: hidden;
                text-align: center;
                border: 1px solid rgba(139, 90, 43, 0.3);
                backdrop-filter: blur(5px);
            }
            
            .coffee-container::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 10px;
                background: linear-gradient(90deg, 
                    var(--coffee-uganda-green) 0%, 
                    var(--coffee-uganda-medium) 50%, 
                    var(--coffee-uganda-gold) 100%);
            }
            
            .coffee-header {
                font-family: 'Dancing Script', cursive;
                color: var(--coffee-uganda-medium);
                font-size: 4.5rem;
                margin: 1rem 0;
                text-align: center;
                font-weight: 700;
                position: relative;
                display: inline-block;
                text-shadow: 1px 1px 3px rgba(139, 90, 43, 0.2);
            }
            
            .coffee-header::after {
                content: "";
                position: absolute;
                bottom: -10px;
                left: 25%;
                width: 50%;
                height: 3px;
                background: linear-gradient(90deg, transparent, var(--coffee-uganda-gold), transparent);
            }
            
            .coffee-subheader {
                color: var(--coffee-uganda-green);
                font-size: 1.5rem;
                text-align: center;
                margin: 1.5rem 0 3rem;
                font-weight: 500;
                line-height: 1.6;
            }
            
            .welcome-message {
                font-size: 1.1rem;
                color: var(--coffee-uganda-dark);
                line-height: 1.8;
                max-width: 600px;
                margin: 0 auto 3rem;
                padding: 1.5rem;
                border-radius: 15px;
                background-color: rgba(255, 248, 225, 0.7);
                border: 1px dashed var(--coffee-uganda-gold);
                position: relative;
                font-style: italic;
            }
            
            .welcome-message::before, .welcome-message::after {
                content: "🌱";
                position: absolute;
                font-size: 1.2rem;
                color: var(--coffee-uganda-green);
            }
            
            .welcome-message::before {
                top: -10px;
                left: -10px;
            }
            
            .welcome-message::after {
                bottom: -10px;
                right: -10px;
            }
            
            .coffee-nav {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 1.5rem;
                margin: 2rem 0;
            }
            
            .coffee-nav a {
                display: inline-flex;
                align-items: center;
                padding: 1rem 2.5rem;
                margin: 0 0.5rem;
                border-radius: 50px;
                text-decoration: none;
                transition: all 0.3s ease;
                font-weight: 500;
                font-family: 'Instrument Sans', sans-serif;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                min-width: 200px;
                justify-content: center;
            }
            
            .coffee-nav .login {
                color: var(--coffee-uganda-medium);
                border: 2px solid var(--coffee-uganda-gold);
                background: white;
            }
            
            .coffee-nav .login:hover {
                background-color: var(--coffee-uganda-gold);
                color: white;
                transform: translateY(-2px);
            }
            
            .coffee-nav .register {
                background: linear-gradient(135deg, var(--coffee-uganda-green), var(--coffee-uganda-medium));
                color: white;
                border: 2px solid var(--coffee-uganda-green);
            }
            
            .coffee-nav .register:hover {
                background: linear-gradient(135deg, var(--coffee-uganda-medium), var(--coffee-uganda-green));
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(139, 90, 43, 0.3);
            }
            
            .coffee-icon {
                margin-left: 0.8rem;
                transition: transform 0.3s ease;
            }
            
            .coffee-nav a:hover .coffee-icon {
                transform: scale(1.2);
            }
            
            .coffee-footer {
                margin-top: 3rem;
                color: var(--coffee-uganda-medium);
                font-size: 0.9rem;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .uganda-flag {
                display: inline-flex;
                margin: 0 0.5rem;
            }
            
            .flag-color {
                width: 15px;
                height: 15px;
                margin: 0 2px;
            }
            
            .black { background-color: #000000; }
            .yellow { background-color: #FCDC04; }
            .red { background-color: #D90000; }
            
            @media (max-width: 768px) {
                .coffee-container {
                    padding: 3rem 1.5rem;
                }
                
                .coffee-header {
                    font-size: 3rem;
                }
                
                .coffee-subheader {
                    font-size: 1.2rem;
                }
                
                .coffee-nav {
                    flex-direction: column;
                    align-items: center;
                }
                
                .coffee-nav a {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <div class="coffee-wrapper">
            <div class="coffee-container">
                <h1 class="coffee-header">Golden Bean</h1>
                <p class="coffee-subheader">From Uganda's Fertile Highlands to the World's Finest Cups</p>
                
                <div class="welcome-message">
                    "Uganda's coffee is like liquid gold, nurtured by the red volcanic soils of the Rwenzori and Elgon Mountains. 
                    This system honors every hand that cultivates, harvests, and transports our treasured beans."
                </div>
                
                @if (Route::has('login'))
                    <nav class="coffee-nav">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="register">
                                Farm Dashboard <i class="fas fa-seedling coffee-icon"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="login">
                                 Login <i class="fas fa-leaf coffee-icon"></i>
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="register">
                                    Join Our Network <i class="fas fa-hands-helping coffee-icon"></i>
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
                
                <div class="coffee-footer">
                    <p>
                        Proudly Ugandan 
                        <span class="uganda-flag">
                            <span class="flag-color black"></span>
                            <span class="flag-color yellow"></span>
                            <span class="flag-color red"></span>
                        </span>
                        | Tracking Excellence from Seed to Export
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
