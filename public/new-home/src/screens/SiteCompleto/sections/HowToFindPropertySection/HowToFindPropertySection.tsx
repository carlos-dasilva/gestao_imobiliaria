import React from "react";
import { Card, CardContent } from "../../../../components/ui/card";

const steps = [
  {
    title: "DEFINA SUAS NECESSIDADES",
    description:
      "Conversamos sobre suas prioridades: localização, tamanho, orçamento e características essenciais para sua família.",
    alignment: "left",
  },
  {
    title: "SELEÇÃO PERSONALIZADA",
    description:
      "Apresento opções que realmente fazem sentido para você, sem perda de tempo com imóveis fora do seu perfil.",
    alignment: "right",
  },
  {
    title: "VISITAS ACOMPANHADAS",
    description:
      "Acompanho cada visita pessoalmente, destacando pontos importantes e respondendo suas dúvidas em tempo real.",
    alignment: "left",
  },
  {
    title: "NEGOCIAÇÃO SEGURA",
    description:
      "Conduzo todo o processo de negociação com transparência, garantindo as melhores condições para sua aquisição.",
    alignment: "right",
  },
];

export const HowToFindPropertySection = (): JSX.Element => {
  return (
    <section className="relative w-full bg-[#fff8ef] py-[50px]">
      <div className="container mx-auto px-4 max-w-[1440px]">
        <h2 className="translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:200ms] text-center [font-family:'Archivo_Narrow',Helvetica] font-bold italic text-[#6e1010] text-[44px] tracking-[0] leading-[44.0px] mb-[15px]">
          COMO ENCONTRAR SEU IMÓVEL IDEAL
        </h2>

        <p className="translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:400ms] text-center [font-family:'Roboto',Helvetica] font-normal text-[#6e6e6e] text-[23px] tracking-[0] leading-[23.0px] max-w-[725px] mx-auto mb-[55px]">
          Um processo estruturado para que você tenha segurança em cada etapa,
          da escolha ate a estrga das chaves
        </p>

        <div className="relative max-w-[1054px] mx-auto">
          <div className="absolute left-1/2 top-0 bottom-[49px] w-[5px] bg-[#6e1010] -translate-x-1/2 hidden md:block" />

          <div className="absolute left-1/2 top-0 bottom-[49px] -translate-x-1/2 hidden md:block">
            <img
              className="w-[50px] h-[497px] object-contain"
              alt="Timeline markers"
              src="https://c.animaapp.com/mht8rhtrvso9Rd/img/group-58.png"
            />
          </div>

          <div className="flex flex-col gap-[50px]">
            {steps.map((step, index) => (
              <div
                key={index}
                className={`translate-y-[-1rem] animate-fade-in opacity-0 flex ${
                  step.alignment === "right"
                    ? "md:justify-end"
                    : "md:justify-start"
                }`}
                style={
                  {
                    "--animation-delay": `${600 + index * 200}ms`,
                  } as React.CSSProperties
                }
              >
                <Card className="w-full md:w-[482px] bg-[#f7f7f7] border-[#d5d5d5] shadow-[3px_3px_6.6px_#00000014] rounded-[5px]">
                  <CardContent className="p-5">
                    <h3 className="[font-family:'Roboto',Helvetica] font-bold text-[#6e1010] text-lg tracking-[0] leading-[18.0px] mb-2.5">
                      {step.title}
                    </h3>
                    <p className="[font-family:'Roboto',Helvetica] font-normal text-[#898888] text-base tracking-[0] leading-[16.0px]">
                      {step.description}
                    </p>
                  </CardContent>
                </Card>
              </div>
            ))}
          </div>
        </div>

        <div className="mt-[66px] w-full h-0.5 bg-[#d5d5d5]">
          <img
            className="w-full h-0.5"
            alt="Section divider"
            src="https://c.animaapp.com/mht8rhtrvso9Rd/img/line-11-1.svg"
          />
        </div>
      </div>
    </section>
  );
};
