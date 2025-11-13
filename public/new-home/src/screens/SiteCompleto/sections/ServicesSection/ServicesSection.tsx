import React from "react";
import { Card, CardContent } from "../../../../components/ui/card";

const servicesData = [
  {
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-2.svg",
    title: "Intermediação de Compra e Venda",
    iconClass: "w-[33px] h-[34px]",
  },
  {
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-1.svg",
    title: "Avaliação de Imóveis",
    iconClass: "w-[34px] h-[31px]",
  },
  {
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-8.svg",
    title: "Consultoria para Financiamento",
    iconClass: "w-9 h-8",
  },
  {
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-7.svg",
    title: "Orientação Documental",
    iconClass: "w-6 h-[30px]",
  },
];

export const ServicesSection = (): JSX.Element => {
  return (
    <section className="w-full max-w-[379px]">
      <header className="flex flex-col items-end gap-[11px] mb-[14px]">
        <h2 className="w-full text-right pr-[18px] [font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-[#6e1010] text-[35px] tracking-[0] leading-[35.0px]">
          Meus Serviços Imobiliários
        </h2>
        <img
          className="w-[379px] h-[3px]"
          alt="Line"
          src="https://c.animaapp.com/mht8rhtrvso9Rd/img/line-4.svg"
        />
      </header>

      <div className="grid grid-cols-2 gap-x-[30px] gap-y-[29px]">
        {servicesData.map((service, index) => (
          <Card
            key={index}
            className="w-[140px] h-[106px] bg-[#f7f7f7] rounded-[10px] shadow-[1px_1px_6.2px_#00000021] border-0"
          >
            <CardContent className="p-[15px] flex flex-col items-center gap-2.5 h-full">
              <img
                className={service.iconClass}
                alt={service.title}
                src={service.icon}
              />
              <p className="w-[110px] h-8 bg-[linear-gradient(90deg,rgba(110,16,16,1)_0%,rgba(238,10,9,1)_100%)] [-webkit-background-clip:text] bg-clip-text [-webkit-text-fill-color:transparent] [text-fill-color:transparent] [font-family:'Roboto',Helvetica] font-bold text-transparent text-sm text-center tracking-[0] leading-[14.0px]">
                {service.title}
              </p>
            </CardContent>
          </Card>
        ))}
      </div>
    </section>
  );
};
