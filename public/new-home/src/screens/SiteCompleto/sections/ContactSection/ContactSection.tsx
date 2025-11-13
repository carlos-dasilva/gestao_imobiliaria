import { ClockIcon, MailIcon, PhoneIcon } from "lucide-react";
import React from "react";
import { Button } from "../../../../components/ui/button";
import { Card, CardContent } from "../../../../components/ui/card";

const contactCards = [
  {
    icon: ClockIcon,
    title: "HORÁRIO DE ATENDIMENTO",
    content: ["Segunda à sexta 08:00 ÀS 17:00", "Sábados 09:00 às 13:00"],
  },
  {
    icon: PhoneIcon,
    title: "TELEFONE DE CONTATO",
    content: ["(51) 99453-1889 - Ligação ou WhatsApp."],
  },
  {
    icon: MailIcon,
    title: "E-MAIL DE CONTATO",
    content: ["catiaalexandra@hotmail.com"],
  },
];

export const ContactSection = (): JSX.Element => {
  return (
    <section className="relative w-full bg-[#fff8ef] py-[70px]">
      <div className="w-full h-0.5 bg-gradient-to-r from-[#6e1010] to-[#ee0a09] absolute top-0 left-0" />

      <div className="container mx-auto px-4 max-w-[1440px]">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
          <div className="flex flex-col justify-start translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:200ms]">
            <h2 className="bg-[linear-gradient(270deg,rgba(110,16,16,1)_0%,rgba(238,10,9,1)_100%)] [-webkit-background-clip:text] bg-clip-text [-webkit-text-fill-color:transparent] [text-fill-color:transparent] [font-family:'Archivo_Narrow',Helvetica] italic text-transparent text-[49px] leading-[73px] font-bold tracking-[0] mb-4">
              ATENDIMENTO RÁPIDO, FÁCIL E DIRETO É COM
            </h2>

            <div className="bg-[linear-gradient(270deg,rgba(238,10,9,1)_0%,rgba(143,21,21,1)_100%)] [-webkit-background-clip:text] bg-clip-text [-webkit-text-fill-color:transparent] [text-fill-color:transparent] [font-family:'Allura',Helvetica] font-normal text-transparent text-[75px] tracking-[0] leading-[65px] mb-8">
              Catia
            </div>

            <p className="[font-family:'Roboto',Helvetica] font-normal text-[#6e1010] text-[23px] tracking-[0] leading-[23.0px] mb-10 max-w-[571px]">
              Disponível para atender você com atenção e agilidade, seja online
              ou presencial.
            </p>

            <Button className="w-fit h-auto px-5 py-2.5 rounded-[10px] border border-solid border-[#761212] shadow-[0px_4px_4px_#00000040] bg-[linear-gradient(270deg,rgba(110,16,16,1)_0%,rgba(238,10,9,1)_100%)] hover:opacity-90 transition-opacity">
              <span className="[font-family:'Roboto',Helvetica] font-semibold italic text-white text-2xl tracking-[0] leading-[normal] mr-2">
                Falar com Catia
              </span>
              <img
                className="w-[25px] h-6"
                alt="Arrow"
                src="https://c.animaapp.com/mht8rhtrvso9Rd/img/group-1.png"
              />
            </Button>
          </div>

          <div className="flex flex-col gap-6 translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:400ms]">
            {contactCards.map((card, index) => {
              const IconComponent = card.icon;
              return (
                <Card
                  key={index}
                  className="bg-[#f7f7f7] rounded-[10px] shadow-[4px_4px_7px_#00000014] border-0"
                >
                  <CardContent className="p-6">
                    <div className="flex gap-5">
                      <div className="w-[60px] h-[60px] rounded-[5px] bg-[linear-gradient(270deg,rgba(110,16,16,1)_0%,rgba(238,10,9,1)_100%)] flex items-center justify-center flex-shrink-0">
                        <IconComponent className="w-[30px] h-[30px] text-white" />
                      </div>

                      <div className="flex-1">
                        <div className="flex flex-col gap-1 mb-6">
                          <h3 className="[font-family:'Archivo_Narrow',Helvetica] font-bold italic text-[#6e1010] text-[22px] tracking-[0] leading-[normal]">
                            {card.title}
                          </h3>
                          <div className="w-full h-0.5 bg-gradient-to-r from-[#6e1010] to-[#ee0a09]" />
                        </div>

                        <div className="flex flex-col gap-[7px]">
                          {card.content.map((text, textIndex) => (
                            <p
                              key={textIndex}
                              className="[font-family:'Roboto',Helvetica] font-normal text-[#646464] text-base tracking-[0] leading-[normal]"
                            >
                              {text}
                            </p>
                          ))}
                        </div>
                      </div>
                    </div>
                  </CardContent>
                </Card>
              );
            })}
          </div>
        </div>
      </div>

      <div className="w-full h-0.5 bg-gradient-to-r from-[#6e1010] to-[#ee0a09] absolute bottom-0 left-0" />
    </section>
  );
};
