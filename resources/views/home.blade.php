@extends('layouts/main')

@section('content')
<div class="homepage">
  <div class="svg-image-box">
    <svg id="small1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">                    <defs>                         <linearGradient id="sw-gradient" x1="0" x2="1" y1="1" y2="0">                            <stop id="stop1" stop-color="rgba(128, 203, 196, 1)" offset="0%"></stop>                            <stop id="stop2" stop-color="rgba(42, 45, 62, 1)" offset="100%"></stop>                        </linearGradient>                    </defs>                <path fill="url(#sw-gradient)" d="M22,5C22,15.8,11,31.6,-1.1,31.6C-13.1,31.6,-26.2,15.8,-26.2,5C-26.2,-5.7,-13.1,-11.4,-1.1,-11.4C11,-11.4,22,-5.7,22,5Z" width="100%" height="100%" transform="translate(50 50)" style="transition: all 0.3s ease 0s;" stroke-width="0"></path>              </svg>
    <svg id="small2" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">                    <defs>                         <linearGradient id="sw-gradient" x1="0" x2="1" y1="1" y2="0">                            <stop id="stop1" stop-color="rgba(128, 203, 196, 1)" offset="0%"></stop>                            <stop id="stop2" stop-color="rgba(42, 45, 62, 1)" offset="100%"></stop>                        </linearGradient>                    </defs>                <path fill="url(#sw-gradient)" d="M22,5C22,15.8,11,31.6,-1.1,31.6C-13.1,31.6,-26.2,15.8,-26.2,5C-26.2,-5.7,-13.1,-11.4,-1.1,-11.4C11,-11.4,22,-5.7,22,5Z" width="100%" height="100%" transform="translate(50 50)" style="transition: all 0.3s ease 0s;" stroke-width="0"></path>              </svg>
    <svg id="small3" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">                    <defs>                         <linearGradient id="sw-gradient" x1="0" x2="1" y1="1" y2="0">                            <stop id="stop1" stop-color="rgba(128, 203, 196, 1)" offset="0%"></stop>                            <stop id="stop2" stop-color="rgba(42, 45, 62, 1)" offset="100%"></stop>                        </linearGradient>                    </defs>                <path fill="url(#sw-gradient)" d="M22,5C22,15.8,11,31.6,-1.1,31.6C-13.1,31.6,-26.2,15.8,-26.2,5C-26.2,-5.7,-13.1,-11.4,-1.1,-11.4C11,-11.4,22,-5.7,22,5Z" width="100%" height="100%" transform="translate(50 50)" style="transition: all 0.3s ease 0s;" stroke-width="0"></path>              </svg>
  </div>
  <div class="container-centered">
    <div class="info">
      <h1 class="first">Hi,</h1> <h1 class="second">I'm Alessandro Amormino</h1>
      <h3 class="third">Full Stack Web <span>Developer</span></h3>
      <div class="buttons">
        <button class="_btn _btn-primary">View works</button>
        <button class="_btn _btn-secondary">Contact me</button>
      </div>
    </div>
    <div class="svg-image">
      <svg id="sw-js-blob-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient" x1="0" x2="1" y1="1" y2="0"><stop id="stop1" stop-color="rgba(128, 203, 196, 1)" offset="0%"></stop>                            <stop id="stop2" stop-color="rgba(42, 45, 62, 1)" offset="100%"></stop>                        </linearGradient>                    </defs>                <path fill="url(#sw-gradient)" d="M32.4,-17.5C38,-9,35.8,5.2,29.1,15.2C22.4,25.3,11.2,31.2,-1.1,31.8C-13.5,32.5,-27,27.9,-29.4,20.4C-31.8,12.8,-23.2,2.2,-16.4,-6.9C-9.7,-16,-4.9,-23.6,4.3,-26C13.4,-28.5,26.8,-25.9,32.4,-17.5Z" width="100%" height="100%" transform="translate(50 50)" style="transition: all 0.3s ease 0s;" stroke-width="0" stroke="url(#sw-gradient)"></path></svg>
    </div>
  </div>
</div>
@endsection