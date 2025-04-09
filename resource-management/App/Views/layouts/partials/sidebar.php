<style>
        /* Styles personnalisés pour la barre latérale */
        /* */#sidebarMenu {
            height: 100vh;
            background-color: #343a40 !important;
            color: white;
        }
        #sidebarMenu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        #sidebarMenu ul li {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 1px solid #6c757d;
        }
        #sidebarMenu ul li:hover {
            background-color: #495057;
        }
        #sidebarMenu ul li a{
            color: white;
            text-decoration: none;
            display: flex; 
            align-items: center; 
        }
        #sidebarMenu ul li a i{
            margin-right: 10px; 
            width: 20px; 
            text-align: center; 
        }
        .top-block {
          display: flex;
          width: 100%;
          padding-block: 5px;
          flex-direction: column;
          align-items: center;
          border-bottom: 1px solid #6c757d;
        } 
        #sidebarMenu h1 {
            padding-inline: 20px;
            text-align: center;
            font-size: 25px;
        }
        img{
          width: 80px;
          height: 80px;
          /* height: auto; */
          object-fit: cover;
          border-radius: 50%;
        }

    </style>
  <nav id="sidebarMenu" style="height: 100%; height: 100vh;" class="sticky col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="top-block">
            <h1 class="h1">IUG</h1>
            <img src="/logo-iug.png" alt="Logo IUG">
            <h2 class="h5">Gestion Composants et rebus</h2>
          </div>
            <ul id="menu">
            </ul>
  </nav>

    <script>
      const menuData = {
      responsable_laboratoire: [
          { title: "Dashboard", icon: "fas fa-tachometer-alt", link: "dashboard/technicien" },
          { title: "Utilisateurs", icon: "fas fa-users", link: "users" },
          { title: "Catégories", icon: "fas fa-tags", link: "categories" },
          { title: "Laboratoires", icon: "fas fa-flask", link: "laboratories" },
          { title: "Services", icon: "fas fa-tools", link: "services" },
          { title: "Matériels", icon: "fas fa-desktop", link: "materials" },
          { title: "Rebus", icon: "fas fa-trash-alt", link: "rebus" },
          { title: "Affectations", icon: "fas fa-link", link: "affectations" },
          { title: "Demandes", icon: "fas fa-clipboard-list", link: "demandes_changement" }, // New link
          { title: "Déconnexion", icon: "fas fa-sign-out-alt", link: "auth/logout" },
      ],
      technicien: [
          { title: "Dashboard", icon: "fas fa-tachometer-alt", link: "dashboard/technicien" },
          { title: "Rebus", icon: "fas fa-trash-alt", link: "rebus" },
          { title: "Demandes", icon: "fas fa-clipboard-list", link: "demandes_changement" }, // New Link
          { title: "Déconnexion", icon: "fas fa-sign-out-alt", link: "auth/logout" },
      ],
        utilisateur: [
            { title: "Dashboard", icon: "fas fa-tachometer-alt", link: "dashboard/utilisateur" },
            { title: "Demande de Changement", icon: "fas fa-file-alt", link: "demandes_changement/create" }, // New Link
            { title: "Déconnexion", icon: "fas fa-sign-out-alt", link: "auth/logout" },
        ],
      
        };

        const role = "<?php echo $_SESSION['user_role']; ?>"; 
        const menuElement = document.getElementById("menu");
        const menuItems = menuData[role];
        if (menuItems) {
            menuItems.forEach(item => {
                console.log(role);
                const li = document.createElement("li");
                li.innerHTML = `<a href="/${item.link}"><i class="${item.icon}"></i>${item.title}</a>`;
                menuElement.appendChild(li);
            });
        } else {
          window.location.href('/login');
          const li = document.createElement("li");
                li.innerHTML = `<a href="/"><i class=""></i>Bla Bla</a>`;
                //menuElement.appendChild(li);
            // Gérer le cas où le rôle n'est pas reconnu (par exemple, redirection)
            // window.location.href = "/login"; // Rediriger vers la page de connexion
        }
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>
