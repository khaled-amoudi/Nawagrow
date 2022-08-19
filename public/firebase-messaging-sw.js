/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyDAcRNwBERP82FmiKCMvmM0KxuS4OizWpg",
    authDomain: "rt-laravel-notifications.firebaseapp.com",
    projectId: "rt-laravel-notifications",
    storageBucket: "rt-laravel-notifications.appspot.com",
    messagingSenderId: "86889874098",
    appId: "1:86889874098:web:89c327b67d17c540327fab",
    measurementId: "G-CVSF58VSD3"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});

// Sender ID => 86889874098
// FCM key => BO7UjzeEuvA8CG6LED9S__GcHxu55TGQjE5ZApDnyEP_Tzm-yToe81GecH--akS3CRqhks4Kn8z0Tl59IvtWQck
