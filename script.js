function toggleMode() {
    const html = document.documentElement
    html.classList.toggle("light")
  }
  
  // function getUserDataFromGit() {
  //   const social_links = document.querySelector("#social-links")
  
  //   axios("https://api.github.com/users/" + _BOHR_REPO_OWNER).then((response) => {
  //     userData = response.data
  //     document.querySelector("#profile h1").innerText = userData.name
  
  //     document.querySelector("#username").innerText = `@${userData.login}`
  //     document.querySelector("#github").href = userData.html_url
  //     document.querySelector("#profile img").src = userData.avatar_url
  
  //     if (userData.twitter_username) {
  //       const link_twitter = document.createElement("a")
  //       link_twitter.setAttribute(
  //         "href",
  //         `https://twitter.com/${userData.twitter_username}`
  //       )
  //       link_twitter.setAttribute("target", "_blank")
  //       link_twitter.innerHTML = '<ion-icon name="logo-twitter"></ion-icon>'
  
  //       social_links.appendChild(link_twitter)
  //     }
  //   })
  // }
  
  // function getAllProjectsBorh() {
  //   axios("https://bohr.io/api/public/user/projects/" + _BOHR_REPO_OWNER).then(
  //     (reponse) => {
  //       const projects_list = document.querySelector("#project-list")
  //       const projects = reponse.data
  //       console.log(projects)
  //       projects.map((project) => {
  //         const project_li = document.createElement("li")
  //         const project_a = document.createElement("a")
  //         project_a.innerHTML = project.name
  //         project_a.setAttribute("href", project.url)
  //         project_a.setAttribute("target", "_blank")
  //         project_li.appendChild(project_a)
  //         projects_list.appendChild(project_li)
  //       })
  //     }
  //   )
  // }
  
  // getUserDataFromGit()
  // getAllProjectsBorh()
  