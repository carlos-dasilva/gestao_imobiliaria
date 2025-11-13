import React from "react";
import { Badge } from "../../../../components/ui/badge";
import { Button } from "../../../../components/ui/button";

const navigationItems = [
  { label: "Home", active: true },
  { label: "Imóveis", active: false },
  { label: "Quem Somos", active: false },
  { label: "Como Funciona", active: false },
  { label: "Conteúdo", active: false },
  { label: "Contato", active: false },
];

export const HomeSection = (): JSX.Element => {
  return (
    <section className="relative w-full h-[778px] bg-white overflow-hidden">
      <div className="absolute inset-0 w-full h-full bg-[url(https://c.animaapp.com/mht8rhtrvso9Rd/img/banner-rotativo.svg)] bg-cover bg-center" />

      <div className="absolute inset-0 w-full h-full bg-black opacity-[0.72]" />

      <div className="relative z-10 w-full h-full">
        <header className="flex items-start justify-between px-7 pt-[26px]">
          <img
            className="w-[357px] h-14 translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:0ms]"
            alt="Colorido branco"
            src="https://c.animaapp.com/mht8rhtrvso9Rd/img/colorido-branco-vertical.svg"
          />

          <nav className="flex flex-col items-end gap-[3px] pt-[11px] translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:200ms]">
            <ul className="inline-flex items-center gap-[25px] rounded">
              {navigationItems.map((item, index) => (
                <li key={index}>
                  <a
                    href="#"
                    className="[font-family:'Roboto',Helvetica] font-normal text-white text-xl tracking-[0] leading-normal whitespace-nowrap transition-opacity hover:opacity-80"
                  >
                    {item.label}
                  </a>
                </li>
              ))}
            </ul>

            <img
              className="w-[66px] h-0.5"
              alt="Line"
              src="https://c.animaapp.com/mht8rhtrvso9Rd/img/line-1-3.svg"
            />
          </nav>
        </header>

        <div className="flex flex-col items-start px-7 mt-[326px]">
          <h1 className="[text-shadow:4px_4px_4px_#00000040] [font-family:'Archivo_Narrow',Helvetica] font-bold italic text-white text-[40px] tracking-[0] leading-normal mb-[60px] translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:400ms]">
            ENCONTRE SEU PRÓXIMO LAR CONOSCO
          </h1>

          <div className="flex flex-col gap-3 mb-[13px] translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:600ms]">
            <Badge
              variant="outline"
              className="w-[410px] h-7 rounded-[20px] border-[1.5px] border-transparent bg-transparent [background:linear-gradient(white,white)_padding-box,linear-gradient(270deg,rgba(111,111,115,1)_0%,rgba(180,180,185,1)_24%,rgba(255,255,255,1)_51%,rgba(180,180,185,1)_76%,rgba(111,111,115,1)_100%)_border-box] flex items-center justify-start px-4 gap-2"
            >
              <img
                className="w-[11px] h-2.5"
                alt="Vector"
                src="https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-30.svg"
              />
              <span className="bg-[linear-gradient(270deg,rgba(169,169,169,1)_0%,rgba(255,255,255,1)_51%,rgba(192,192,192,1)_100%)] [-webkit-background-clip:text] bg-clip-text [-webkit-text-fill-color:transparent] [text-fill-color:transparent] [font-family:'Roboto',Helvetica] font-normal text-sm tracking-[0] leading-normal whitespace-nowrap">
                ESPECIALISTA EM PRIMEIRO IMÓVEL E FINANCIAMENTO
              </span>
            </Badge>

            <Badge
              variant="outline"
              className="w-[525px] h-7 rounded-[20px] border-[1.5px] border-transparent bg-transparent [background:linear-gradient(white,white)_padding-box,linear-gradient(270deg,rgba(111,111,115,1)_0%,rgba(180,180,185,1)_13%,rgba(255,255,255,1)_51%,rgba(180,180,185,1)_83%,rgba(111,111,115,1)_100%)_border-box] flex items-center justify-start px-4 gap-[5px]"
            >
              <img
                className="w-2.5 h-2.5"
                alt="Vector"
                src="https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-27.svg"
              />
              <span className="bg-[linear-gradient(270deg,rgba(217,217,217,1)_0%,rgba(255,255,255,1)_51%,rgba(213,213,213,1)_100%)] [-webkit-background-clip:text] bg-clip-text [-webkit-text-fill-color:transparent] [text-fill-color:transparent] [font-family:'Roboto',Helvetica] font-normal text-sm tracking-[0] leading-normal whitespace-nowrap">
                INFORMAÇÕES CLARAS E HONESTAS EM TODAS AS ETAPAS DO PROCESSO
              </span>
            </Badge>
          </div>

          <div className="flex items-center gap-[27px] translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:800ms]">
            <Button className="w-[233px] h-12 rounded-[10px] border border-solid border-[#761212] shadow-[0px_4px_4px_#00000040] bg-[linear-gradient(270deg,rgba(110,16,16,1)_0%,rgba(238,10,9,1)_100%)] [font-family:'Roboto',Helvetica] font-semibold italic text-white text-2xl tracking-[0] leading-normal hover:opacity-90 transition-opacity">
              <span className="flex items-center gap-2">
                Falar com Catia
                <img
                  className="w-[19px] h-[21px]"
                  alt="Group"
                  src="https://c.animaapp.com/mht8rhtrvso9Rd/img/group.png"
                />
              </span>
            </Button>

            <Button
              variant="outline"
              className="w-40 h-12 bg-[#fbfbfb0d] rounded-[10px] border-[0.5px] border-transparent [background:linear-gradient(#fbfbfb0d,#fbfbfb0d)_padding-box,linear-gradient(270deg,rgba(111,111,115,1)_0%,rgba(180,180,185,1)_13%,rgba(255,255,255,1)_51%,rgba(180,180,185,1)_83%,rgba(111,111,115,1)_100%)_border-box] [font-family:'Roboto',Helvetica] font-bold italic text-[#eaeaea] text-xl tracking-[0] leading-normal hover:bg-[#fbfbfb1a] transition-colors"
            >
              VER IMÓVEIS
            </Button>
          </div>
        </div>
      </div>
    </section>
  );
};
