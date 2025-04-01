<style>
        /* Styles personnalisés pour la barre latérale */
        /* */#sidebarMenu {
            height: 100vh;
            background-color: #343a40 !important;
            color: white;
        }
        #sidebarMenu h1 {
            padding: 20px;
            text-align: center;
            font-size: 20px;
            border-bottom: 1px solid #6c757d;
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
    </style>
<nav id="sidebarMenu" style="height: 100%; height: 100vh;" class="sticky col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="">
            <h1 class="h1">Camrail</h1>
            <h2 class="h5">Gestion Lignes</h2>
          </div>
            <ul id="menu">
            </ul>
</nav>

    <script>
        const menuData = {
            admin: [
                { title: "Dashboard", icon: "fas fa-tachometer-alt", link: "dashboard/admin" },
                { title: "Utilisateurs", icon: "fas fa-users", link: "user/management" },
                { title: "Lignes", icon: "fas fa-folder-open", link: "lignes" },
                // { title: "Lignes", icon: "fas fa-folder-open", link: "lignes" },
                { title: "Logs", icon: "fas fa-tachometer-alt", link: "dashboard/logs" },
                // { title: "Tuteurs", icon: "fas fa-user-tie", link: "dashboard/tuteurs" },
                // { title: "Affectations", icon: "fas fa-link", link: "dashboard/affectations" },
                // { title: "Tâches", icon: "fas fa-tasks", link: "taches" },
                // { title: "Documents", icon: "fas fa-folder-open", link: "documents" },
                // { title: "Evaluations", icon: "fas fa-star-half-alt", link: "evaluations" },
                // { title: "Retards", icon: "fas fa-exclamation-triangle", link: "retards" }
            ],
            classic: [
                { title: "Dashboard", icon: "fas fa-tachometer-alt", link: "dashboard/classic" },
                { title: "Lignes", icon: "fas fa-folder-open", link: "lignes" },
                { title: "Deconnexion", icon: "fas fa-sign-out-alt", link: "/auth/logout" },
                // { title: "Evaluations", icon: "fas fa-star-half-alt", link: "evaluations/supervisor" },
                // { title: "Retards", icon: "fas fa-exclamation-triangle", link: "retards" }
            ],
            // tuteur: [
            //     { title: "Dashboard", icon: "fas fa-tachometer-alt", link: "/tuteur" },
            //     { title: "Stagiaires", icon: "fas fa-graduation-cap", link: "tuteur/stagiaires" },
            //     { title: "Tâches", icon: "fas fa-tasks", link: "taches/" },
            //     { title: "Documents", icon: "fas fa-folder-open", link: "documents/tutor" },
            //     { title: "Evaluations", icon: "fas fa-star-half-alt", link: "evaluations/tutor" },
            //     { title: "Retards", icon: "fas fa-exclamation-triangle", link: "retards" }
            //   ],
            // stagiaire: [
            //     { title: "Dashboard", icon: "fas fa-tachometer-alt", link: "/stagiaire" },
            //     { title: "Tâches", icon: "fas fa-tasks", link: "tasks/intern" },
            //     { title: "Documents", icon: "fas fa-folder-open", link: "documents/intern" },
            // ],
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
            // Gérer le cas où le rôle n'est pas reconnu (par exemple, redirection)
            window.location.href = "/login"; // Rediriger vers la page de connexion
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
