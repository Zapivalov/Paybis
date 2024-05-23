# Quickstart

## System requirements
- OrbStack installed (see [OrbStack overview](https://orbstack.dev/download))
 or
- Docker Engine installed (see [Docker Engine overview](https://docs.docker.com/install/))

## Infrastructure

### Setup

Infrastructure is setup via docker-compose. Run the following commands in a sequence:

- `docker compose up -d`
- `make install`
- `make db`
- `make currency-update` (To upload actual currencies)

# API documentation

## Request

GET http://localhost:8000/api/rates

### Parameters

- `currency` (optional): Specifies the currency for which to retrieve rates. Default value is USD.
- `start_date` (optional): Specifies the start date for the rate history. Format (ISO 8601): Y-m-d\TH:i:sP.
- `end_date` (optional): Specifies the end date for the rate history. Format (ISO 8601): Y-m-d\TH:i:sP.

If the interval is not specified, the entire time is sampled.

Supported currencies (current currencies are updated from the exchange https://www.coingecko.com/):
"aed,ars,aud,bch,bdt,bhd,bits,bmd,bnb,brl,btc,cad,chf,clp,cny,czk,dkk,dot,eos,eth,eur,gbp,gel,hkd,huf,idr,ils,inr,jpy,krw,kwd,link,lkr,ltc,mmk,mxn,myr,ngn,nok,nzd,php,pkr,pln,rub,sar,sats,sek,sgd,thb,try,twd,uah,usd,vef,vnd,xag,xau,xdr,xlm,xrp,yfi,zar"

### Example

GET http://localhost:8000/api/rates?currency=pln&start_date=2024-05-23T18:50:00Z

Response:
[
{
"date_time": "2024-05-23T18:50:02+00:00",
"rate": 264984.47433467
},
{
"date_time": "2024-05-23T18:55:02+00:00",
"rate": 265857.10113236
}
]


