import React from "react";

const journeyItems = [
  {
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/group-18.svg",
    text: "Graduação em Gestão Financeira e Ciências Sociais",
    iconClasses: "mt-[9px] w-7 h-6 ml-1.5",
    textClasses: "w-[301px] h-[42px] mr-0.5",
    containerClasses: "w-[353px] h-[42px]",
    delay: "200ms",
  },
  {
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-11.svg",
    text: "Atuação na Caixa Econômica Federal",
    iconClasses: "mt-[7px] w-7 h-[25px] mr-1.5",
    textClasses: "mt-[9px] w-[298px] h-[21px] mr-0.5 whitespace-nowrap",
    containerClasses: "w-[350px] h-10",
    delay: "400ms",
  },
  {
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-14.svg",
    text: "Formação técnica em Transações Imobiliárias",
    iconClasses: "mt-2 w-6 h-[23px] mr-2",
    textClasses: "mt-[9px] w-[370px] h-[21px] mr-0.5 whitespace-nowrap",
    containerClasses: "w-[422px] h-10",
    delay: "600ms",
  },
  {
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-10.svg",
    text: "Certificação de avaliadora pelo Ibrep para avaliação oficial de imóveis",
    iconClasses: "mt-1.5 w-5 h-7 mr-2.5",
    textClasses: "w-[352px] h-[42px] mr-0.5",
    containerClasses: "w-[404px] h-[42px]",
    delay: "800ms",
  },
];

export const JourneySection = (): JSX.Element => {
  return (
    <section className="w-full max-w-[420px] relative">
      <header className="flex flex-col items-end gap-[11px]">
        <h2 className="mr-[88px] w-[295px] h-[47px] [font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-[#6e1010] text-[35px] tracking-[0] leading-[35.0px]">
          Trajetória Profissional
        </h2>

        <img
          className="mr-0.5 w-[381px] h-[3px]"
          alt=""
          src="https://c.animaapp.com/mht8rhtrvso9Rd/img/line-4-2.svg"
        />
      </header>

      <div className="mt-[21px] relative">
        <div className="absolute left-[18px] top-[50px] flex flex-col gap-[11px]">
          <img
            className="w-0.5 h-[50px]"
            alt=""
            src="https://c.animaapp.com/mht8rhtrvso9Rd/img/line-5.svg"
          />
          <img
            className="w-0.5 h-[50px]"
            alt=""
            src="https://c.animaapp.com/mht8rhtrvso9Rd/img/line-6.svg"
          />
          <img
            className="w-0.5 h-[50px]"
            alt=""
            src="https://c.animaapp.com/mht8rhtrvso9Rd/img/line-6.svg"
          />
        </div>

        <div className="flex flex-col gap-[11px]">
          {journeyItems.map((item, index) => (
            <div
              key={index}
              className={`flex justify-between ${item.containerClasses}`}
            >
              <div
                className={`${index === 0 ? "mt-0.5" : index === 3 ? "mt-0.5" : ""} w-10 h-10 flex ${index === 1 || index === 2 || index === 3 ? "justify-end" : ""} rounded-[5px] bg-[linear-gradient(180deg,rgba(110,16,16,1)_0%,rgba(238,10,9,1)_100%)]`}
              >
                <img className={item.iconClasses} alt="" src={item.icon} />
              </div>

              <p
                className={`${item.textClasses} [font-family:'Roboto',Helvetica] font-normal text-[#6e1010] text-lg tracking-[0] leading-[18.0px]`}
              >
                {item.text}
              </p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};
