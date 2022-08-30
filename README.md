# Craft CMS 4 Starter
_Based on a Craft 3 starter by [Andrew Welch of @nystudio107](https://nystudio107.com)_


This starter can be used by anyone but @ryanirelan created it for his courses @CraftQuest courses. 

## Instructions to Use this Starter

To use this starter project, you will need to run Docker Desktop (see below, #3). 

### Running the Project Locally

1. Install (or open) [Docker Desktop](https://www.docker.com/products/docker-desktop/) for you operating system.
2. In a terminal window, run `make dev` to start up the Docker containers and launch the starter site. 
3. Once initial build is complete (you should "Ready to handle connections"), point your browser to http://localhost:8080

### Craft Control Panel

The Craft CMS control panel is located at http://localhost:8080/admin. Use username "admin" and password "password" to gain access. 


### Nuxt localhost 

The frontend has been already linked to Craft through a plugin. There is nothing else to do to connect them.

The Nuxt app will be running on http://localhost:3004

Use the folder structure as usual. 

### Adding packages to the frontend

To add a package, make sure you are on the frontend/ folder and add it through yarn.

Most packages will be automatically added to the container once it is restarted. Control+ C, stops all the running containers, 'make dev' will restart the project (In case a restart is needed).

If any issues when adding packages, let Alejandro know. (He is working on a command to add them to the running container without having to restart them).

