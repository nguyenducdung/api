
  // Initialize Firebase
  var config = {
      apiKey: "AIzaSyAX0PkwiAHSUpCUwAg5AxiuhDB_4XAfKs0",
      authDomain: "datnsmartoder.firebaseapp.com",
      databaseURL: "https://datnsmartoder.firebaseio.com",
      projectId: "datnsmartoder",
      storageBucket: "datnsmartoder.appspot.com",
      messagingSenderId: "8621197450",
      appId: "1:8621197450:web:64512594c9d6cd1b9d4573",
      measurementId: "G-2HKFCZJM5B"
  };

  firebase.initializeApp(config);
  const messaging = firebase.messaging();

  messaging.requestPermission().then(function() {
      //getToken(messaging);
      return messaging.getToken();
  }).then(function(token){
      console.log('token: '+token);
  })
      .catch(function(err) {
          console.log('Permission denied', err);
      });
  messaging.onMessage(function(payload){
      console.log('onMessage: ',payload);
  });

  function pushNotification(food_name) {
      var key = 'AAAAAgHdCIo:APA91bHuS7MxyWxwdiWIkVJApTRmFAHzCcF80jq9-vpG7e9EjdQsY-ClmTGyuKWVRRoCyZ5ErH6wFqsP6jCiKQOZaHKBYF1QVpU7Q69URiud3Lx9NyJtRWG6mAhwMqUg3AjonbfIDWfr';//key cloud messaging
      var token = 'fnmrAbeI408:APA91bHExqrXK1hOvTKB0lWFplK7xkyzGyXGuX_Rj9Wlc7jPwFOTH5UT8taJIaicSq6V8wSx9dfK1AoHHKjIVrf13qaylcmX3HPKyaG_EZPZp16eokefKjRGhR8idMhovNwoUWQJq9Oz';

      var notification = {
          'title': 'Thông báo từ nhà bếp',
          'body': 'Món ăn:'+food_name+' đã được nhà bếp hoàn thành !'
      };

      fetch('https://fcm.googleapis.com/fcm/send', {
          'method': 'POST',
          'headers': {
              'Authorization': 'key=' + key,
              'Content-Type': 'application/json'
          },
          'body': JSON.stringify({
              'notification': notification,
              'to': token
          })
      }).then(function(response) {
          console.log('push success: '+response);
          // pushLog(notification)
      }).catch(function(error) {
          console.error('push error: '+error);
      })
  }
  function pushLog(data) {

  }