import React from "react";
import { Card, CardContent } from "../../../../components/ui/card";

const properties = [
  {
    image: "https://c.animaapp.com/mht8rhtrvso9Rd/img/rectangle-5.png",
    title: "PEDREIRA | SANTA RITA",
    description:
      "Seu negócio pronto! Ponto comercial ativo + casa em Nova Santa Rita.",
    price: "R$ 279.900,00",
    bedrooms: "2",
    bathrooms: "2",
  },
  {
    image: "https://c.animaapp.com/mht8rhtrvso9Rd/img/rectangle-5-1.png",
    title: "MOINHOS | CANOAS",
    description:
      "Casa aconchegante e com excelente localização no bairro Moinhos",
    price: "R$ 990.00,90",
    bedrooms: "4",
    bathrooms: "2",
  },
  {
    image: "https://c.animaapp.com/mht8rhtrvso9Rd/img/rectangle-5-2.png",
    title: "QUEENS | NEW YORK",
    description: "Casa bem localizada, vivia dois senhores com seu sobrinho.",
    price: "R$ 500.000,00",
    bedrooms: "2",
    bathrooms: "1",
  },
  {
    image: "https://c.animaapp.com/mht8rhtrvso9Rd/img/rectangle-5-3.png",
    title: "TORONTO | CANADA",
    description: "Habitada por dois brasileiros, casa grande com estúdio.",
    price: "R$ 279.900,00",
    bedrooms: "3",
    bathrooms: "3",
  },
];

export const PropertiesSection = (): JSX.Element => {
  return (
    <section className="relative w-full bg-[#fff8ef] py-9">
      <img
        className="absolute top-px left-0 w-full h-[894px] object-cover"
        alt="Background decoration"
        src="https://c.animaapp.com/mht8rhtrvso9Rd/img/group-104.png"
      />

      <img
        className="absolute top-[-3px] left-0 w-full h-2.5"
        alt="Top border decoration"
        src="https://c.animaapp.com/mht8rhtrvso9Rd/img/rectangle-7.svg"
      />

      <div className="relative z-10 container mx-auto px-4">
        <h2 className="translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:200ms] text-center bg-[linear-gradient(270deg,rgba(110,16,16,1)_0%,rgba(210,42,41,1)_100%)] [-webkit-background-clip:text] bg-clip-text [-webkit-text-fill-color:transparent] [text-fill-color:transparent] [font-family:'Archivo_Narrow',Helvetica] font-bold italic text-[40px] tracking-[0] leading-[40.0px] mb-5">
          IMÓVEIS A VENDA
        </h2>

        <p className="translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:400ms] max-w-[688px] mx-auto [font-family:'Roboto',Helvetica] font-normal text-[#898888] text-xl text-center tracking-[0] leading-[20.0px] mb-24">
          Imóveis para todos os estilos e bolsos, com condições especiais de
          pagamento e localização prática para o seu dia a dia.
        </p>

        <div className="relative flex items-center justify-center">
          <button
            className="absolute left-3 z-20 w-16 h-16 flex items-center justify-center transition-transform hover:scale-110"
            aria-label="Previous properties"
          >
            <img
              className="w-full h-full"
              alt="Previous"
              src="https://c.animaapp.com/mht8rhtrvso9Rd/img/group-14.png"
            />
          </button>

          <div className="flex gap-5 overflow-x-auto px-[50px] py-4 scrollbar-hide">
            {properties.map((property, index) => (
              <Card
                key={index}
                className="translate-y-[-1rem] animate-fade-in opacity-0 flex-shrink-0 w-80 bg-white rounded-[20px] shadow-[4px_4px_10px_#00000040] transition-transform hover:scale-105"
                style={
                  {
                    "--animation-delay": `${600 + index * 200}ms`,
                  } as React.CSSProperties
                }
              >
                <CardContent className="p-0">
                  <img
                    className="w-full h-[371px] object-cover rounded-t-[20px]"
                    alt={property.title}
                    src={property.image}
                  />

                  <div className="relative">
                    <img
                      className="w-full h-[2.5px]"
                      alt="Divider"
                      src="https://c.animaapp.com/mht8rhtrvso9Rd/img/line-2.svg"
                    />

                    <div className="px-5 pt-2.5 pb-5 flex flex-col gap-2.5">
                      <h3 className="text-center [font-family:'Archivo_Narrow',Helvetica] font-bold text-[#6e1010] text-[25px] tracking-[0] leading-[25.0px]">
                        {property.title}
                      </h3>

                      <p className="[font-family:'Roboto',Helvetica] font-normal text-[#a6a6a6] text-[15px] tracking-[0] leading-[15.0px] min-h-[36px]">
                        {property.description}
                      </p>

                      <p className="[font-family:'Roboto',Helvetica] font-medium italic text-[#6e1010] text-xl tracking-[0] leading-[20.0px]">
                        {property.price}
                      </p>
                    </div>

                    <img
                      className="w-[282px] h-[1.5px] mx-auto"
                      alt="Divider"
                      src="https://c.animaapp.com/mht8rhtrvso9Rd/img/line-1.svg"
                    />

                    <div className="flex items-center justify-center gap-5 py-4">
                      <div className="relative flex items-center gap-1">
                        <span className="[font-family:'Roboto',Helvetica] font-normal text-black text-[25px] tracking-[0] leading-[25.0px]">
                          {property.bedrooms}
                        </span>
                        <img
                          className="w-8 h-6"
                          alt="Bedrooms"
                          src="https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-3.svg"
                        />
                      </div>

                      <div className="relative flex items-center gap-1">
                        <span className="[font-family:'Roboto',Helvetica] font-normal text-black text-[25px] tracking-[0] leading-[25.0px]">
                          {property.bathrooms}
                        </span>
                        <img
                          className="w-5 h-[27px]"
                          alt="Bathrooms"
                          src="https://c.animaapp.com/mht8rhtrvso9Rd/img/vector.svg"
                        />
                      </div>
                    </div>
                  </div>
                </CardContent>
              </Card>
            ))}
          </div>

          <button
            className="absolute right-3 z-20 w-16 h-16 flex items-center justify-center transition-transform hover:scale-110"
            aria-label="Next properties"
          >
            <img
              className="w-full h-full"
              alt="Next"
              src="https://c.animaapp.com/mht8rhtrvso9Rd/img/group-15.png"
            />
          </button>
        </div>
      </div>

      <img
        className="absolute bottom-0 left-0 w-full h-0.5"
        alt="Bottom border"
        src="https://c.animaapp.com/mht8rhtrvso9Rd/img/line-11.svg"
      />
    </section>
  );
};
