<footer class="footer">
      <div class="foo-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="widget foo-nav">
              <h5>Société</h5>
              <ul>
                <li><a href="{{route('about')}}">Qui sommes-nous</a></li>
                <li><a href="{{route('services')}}">Nos services</a></li>
                <li><a href="{{route('emploi')}}">Emploi</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="widget foo-nav">
              <h5>Aides & ressources</h5>
              <ul>
              <li><a href="{{route('faq')}}">FAQ</a></li>
                <li><a href="{{route('security')}}">Sécurité</a></li>
                <li><a href="{{route('contact')}}">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="widget foo-nav">
              <h5>Juridique</h5>
              <ul>                
                <li><a href="{{route('conditions')}}">Conditions Générales</a></li>
                <li><a href="{{route('terms')}}">Mentions légales</a></li>
                <li><a href="{{route('privacy')}}">Politique de confidentialité</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="widget foo-address">
              <h5>Coordonnées</h5>
              <address>
                <a href="malto:hello@transfertunion.com">hello@transfertunion.com</a><br>
                <a href="tel:{{config('info.app_telephone')}}">{{config('info.app_telephone')}}</a><br>
                <a href="tel:{{config('info.app_telephone2')}}">{{config('info.app_telephone2')}}</a><br>
                 7-1244 Boulevrd Rolland,Montreal, Québec, H1G 6C5, Canada

              </address>
              
            </div>
          </div>
        </div><br>
        <p style="color:#fff;">Le service en ligne Transfert Union est proposé par Transfert Union Inc. Une entité agréée par l'Autorité des marchés financiers
         REVENU QUEBEC dans la catégorie Changement de devise et Transfert de fonds sous le numéro d'enregistrement: M201190571. Permis: 10565997 Canad Inc.
        </p>
      </div>
      </div>
      
      <div class="foo-btm">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="foo-navigation">
                <ul>
                  <li><a href="{{route('conditions')}}">Conditions d'utilisation</a></li>
                  
                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <div class="foo-navigation text-center">
                <ul>
                  @include ("_lang")
                </ul>
              </div>
            </div>
            <div class="col-md-4">
             <div class="copyright">© 2022 Transfert Union. Tous droits réservés.</div>
            </div>
          </div>
        </div>
      </div>
    </footer>