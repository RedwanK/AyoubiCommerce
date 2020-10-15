$(document)
    .ready(function() {
        $('.ui.form')
            .form({
                      fields: {
                          email: {
                              identifier  : 'email',
                              rules: [
                                  {
                                      type   : 'empty',
                                      prompt : 'Entrez votre adresse mail'
                                  },
                                  {
                                      type   : 'email',
                                      prompt : 'Merci d\'entrer une adresse mail valide'
                                  }
                              ]
                          },
                          password: {
                              identifier  : 'password',
                              rules: [
                                  {
                                      type   : 'empty',
                                      prompt : 'Entrez votre mot de passe'
                                  },
                                  {
                                      type   : 'length[6]',
                                      prompt : 'Votre mot de passe doit être composé d\'au moins 6 caractères'
                                  }
                              ]
                          }
                      }
                  })
        ;
    })
;
