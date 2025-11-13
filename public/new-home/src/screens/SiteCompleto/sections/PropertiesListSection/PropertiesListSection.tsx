import React from "react";
import { Card, CardContent } from "../../../../components/ui/card";

const propertyTypes = [
  {
    title: "Zonas Comercias",
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-6.svg",
    iconClass: "w-[39px] h-[31px]",
  },
  {
    title: "Zonas Residenciais",
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/group-45.svg",
    iconClass: "w-[47px] h-7",
  },
  {
    title: "Condomínios Fechados",
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/group-5.svg",
    iconClass: "w-[35px] h-[35px]",
  },
  {
    title: "Áreas em Desenvolvimento",
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-16.svg",
    iconClass: "w-[33px] h-[33px]",
  },
];

export const PropertiesListSection = (): JSX.Element => {
  return (
    <section className="w-full max-w-[379px]">
      <header className="flex flex-col items-end gap-[11px] mb-[14px]">
        <h2 className="w-full text-right pr-[110px] [font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-[#6e1010] text-[35px] tracking-[0] leading-[35.0px]">
          Imóveis Disponíveis
        </h2>

        <img
          className="w-full h-[3px]"
          alt="Line"
          src="https://c.animaapp.com/mht8rhtrvso9Rd/img/line-4.svg"
        />
      </header>

      <div className="grid grid-cols-2 gap-x-[30px] gap-y-[29px]">
        {propertyTypes.map((property, index) => (
          <Card
            key={index}
            className="w-[140px] h-[106px] rounded-[10px] shadow-[1px_1px_6.2px_#00000021] bg-[linear-gradient(270deg,rgba(110,16,16,1)_0%,rgba(238,10,9,1)_100%)] border-0 transition-transform hover:scale-105 cursor-pointer"
          >
            <CardContent className="p-[18px] flex flex-col items-center justify-between h-full">
              <div className="flex items-center justify-center flex-1">
                <img
                  className={property.iconClass}
                  alt={property.title}
                  src={property.icon}
                />
              </div>

              <p className="w-full [font-family:'Roboto',Helvetica] font-bold text-white text-sm text-center tracking-[0] leading-[14.0px] mt-2">
                {property.title}
              </p>
            </CardContent>
          </Card>
        ))}
      </div>
    </section>
  );
};
