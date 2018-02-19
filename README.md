CashMachine API
================
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/felipegirotti/cashmachine/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/felipegirotti/cashmachine/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/felipegirotti/cashmachine/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/felipegirotti/cashmachine/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/felipegirotti/cashmachine/badges/build.png?b=master)](https://scrutinizer-ci.com/g/felipegirotti/cashmachine/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/felipegirotti/cashmachine/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
## The Problem
Develop a solution that simulate the delivery of notes when a client does a withdraw in a cash machine.

The basic requirements are the follow:

Always deliver the lowest number of possible notes;     
It’s possible to get the amount requested with available notes;     
The client balance is infinite;     
Amount of notes is infinite;        
Available notes $ 100,00; $ 50,00; $ 20,00 e $ 10,00        

Example:
```
Entry: 30.00
Result: [20.00, 10.00]

Entry: 80.00
Result: [50.00, 20.00, 10.00]

Entry: 125.00
Result: throw NoteUnavailableException

Entry: -130.00
Result: throw InvalidArgumentException

Entry: NULL
Result: [Empty Set]
```

## Endpoints

We just have one endpoints to receive the value.

`GET /{value}?` 

The {value} not required

## Run tests

`./vendor/bin/simple-phpunit`

There a unit and integration tests.

## Run local
The project is very simple, not required webservice e.g nginx
Just run the command bellow     
`./bin/console server:start`


## Architecture

The problem is very simple and definitely not need the framework to solve it.   
But to show more skills I decided to use a framework, and the choice for Symfony was very easy for me for reasons below: 
- very extensible;
- huge community;
- robust
- fast when you use the proper settings for cache
- dependency injector/ service container more easy to use, define service in files (yml, xml, php)

The decision for version 3.4 was because is LTS.

Regarding the CashMachine I split for 3 services to respect the SOLID:
- BankNotes
- ValidatorService
- CashMachine

### BankNotes
BankNotes to provide the notes and the logic for server notes,      
The CashMachineService not need have knowledge of provider, just only trusty in your Interface.
   
### ValidatorService
The responsible to validate input and if the value is able to business logic

### CashMachine
CashMachineService is responsible to call notes from BankNoteService and delivery notes.

### Controller
For the controller I use the ParamConverter for get the `value` and validate it on layer of controller, 
but totally decouple of controller.




