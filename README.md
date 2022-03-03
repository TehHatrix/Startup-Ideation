# Introduction <img src="https://github.com/TehHatrix/startup-ideation/blob/master/README/logo.png?raw=true" width="48">

Startup Ideation System goal is to help the user stimulate their idea and determine their idea to see if there are opportunities in term of market, problem and product based on real customer feedback. The Startup Ideation System is mainly based on Lean Startup Principle and modified version of Business Model Canvas known as Lean Canvas to ensure the system follow the right path for a startup-based ideation system. 

The target user for the Startup Ideation System is mainly Entrepreneur especially individual that has non-business background and no experiences in managing a startup. The Entrepreneur can fully benefit from the system by using it to stimulate their idea using the Lean Canvas provided and follow the system’s process that is based on Lean Startup Principle to validate the idea stimulated.

There are seven big modules with its respective submodules in the Startup Ideation System which is Ideation module, Project Management module, Customer Sentiment Validation module, Market Validation, Product Validation module, Communication module and To Do module. 

## Tech Stacks
VueJS 2\
Laravel 8\
PostgreSQL

## User Interfaces (Not included all)
<img src="https://github.com/TehHatrix/startup-ideation/blob/master/README/project.png?raw=true" width="1000" height="500">
<img src="https://github.com/TehHatrix/startup-ideation/blob/master/README/Landing%20Editor.png?raw=true" width="800" height="400">
<img src="https://github.com/TehHatrix/startup-ideation/blob/master/README/SurveySummary.png?raw=true" width="800" height="400">

## Usage
*Please make sure Docker and WSL2 is installed in your machine*

To use the system locally, for the front end, navigate to vue-ideation folder and run 
```bash
npm run serve
```
Secondly, for the back-end, navigate to Laravel-Back-End, for first time use, run these commands
```bash
docker run --rm -v $(pwd):/app composer install
sudo chown -R $USER:$USER ~/Laravel-Back-End
```
To make the back-end up and running, run
```bash
docker compose up -d --build
```


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.
