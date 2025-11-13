import React from "react";

const partnershipItems = [
  {
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/group-2.svg",
    title: "ATENDIMENTO INTEGRADO",
    subtitle: "Experiência completa e sem complicações",
    iconWidth: "w-[147px]",
    iconHeight: "h-[98px]",
    iconStyles: "w-[31.97%] h-[59.18%] top-[18.37%] left-[32.65%]",
    lineWidth: "w-[486px]",
  },
  {
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/group-6.svg",
    title: "REDE DE ESPECIALISTAS",
    subtitle: "Experiência completa e sem Profissionais",
    iconWidth: "w-[194px]",
    iconHeight: "h-[105px]",
    iconStyles: "w-[35.05%] h-[61.90%] top-[17.62%] left-[31.70%]",
    lineWidth: "w-[514px]",
  },
  {
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-17.svg",
    title: "INSTITUIÇÕES FINANCEIRAS",
    subtitle: "Bancos e financeiras com condições especiais",
    iconWidth: "w-[226px]",
    iconHeight: "h-[102px]",
    iconStyles: "w-[27.88%] h-[60.78%] top-[17.65%] left-[35.54%]",
    lineWidth: "w-[599px]",
  },
  {
    icon: "https://c.animaapp.com/mht8rhtrvso9Rd/img/vector-12.svg",
    title: "SUPORTE JURÍDICO",
    subtitle: "Advogados e despachantes especializados",
    iconWidth: "w-[265px]",
    iconHeight: "h-[102px]",
    iconStyles: "w-[24.53%] h-[60.78%] top-[16.67%] left-[36.60%]",
    lineWidth: "w-[652px]",
  },
];

export const PartnershipsSection = (): JSX.Element => {
  return (
    <section className="relative w-full bg-[#6e1010] py-12 px-4 md:px-8 lg:px-16">
      <div className="max-w-[1440px] mx-auto">
        <div className="grid grid-cols-1 lg:grid-cols-[1fr_auto] gap-0 items-end">
          <div className="flex flex-col gap-4 pb-8">
            <h2 className="translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:0ms] [font-family:'Archivo_Narrow',Helvetica] font-bold italic text-white text-[35px] tracking-[0] leading-[35px]">
              PARCERIAS ESTRATÉGICAS
            </h2>

            <p className="translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:200ms] [font-family:'Roboto',Helvetica] font-normal text-[#ffe1d5] text-lg tracking-[0] leading-[20px] max-w-[600px]">
              Conto com uma rede de parceiros de confiança para que você tenha
              um serviço completo, do início ao fim. Desde a avaliação técnica
              até a documentação, cada etapa é conduzida por profissionais
              experientes e qualificados.
            </p>

            <div className="flex flex-col gap-4 mt-4">
              {partnershipItems.map((item, index) => (
                <div
                  key={index}
                  className="translate-y-[-1rem] animate-fade-in opacity-0 flex flex-col gap-2"
                  style={
                    {
                      "--animation-delay": `${400 + index * 200}ms`,
                    } as React.CSSProperties
                  }
                >
                  <div className="flex items-start gap-3">
                    <div className="w-[80px] h-[60px] bg-[#f7f7f7] rounded-[10px] flex-shrink-0 relative flex items-center justify-center">
                      <img
                        className="w-[50%] h-[50%] object-contain"
                        alt={item.title}
                        src={item.icon}
                      />
                    </div>

                    <div className="flex flex-col gap-0.5 pt-2">
                      <h3 className="[font-family:'Roboto',Helvetica] font-bold text-[#f7f7f7] text-lg tracking-[0] leading-[20px]">
                        {item.title}
                      </h3>
                      <p className="[font-family:'Roboto',Helvetica] font-normal text-[#ffe2d5] text-sm tracking-[0] leading-[16px]">
                        {item.subtitle}
                      </p>
                    </div>
                  </div>

                  {index < partnershipItems.length - 1 && (
                    <div className="w-full h-[2px] bg-[#ffe2d5] opacity-30" />
                  )}
                </div>
              ))}
            </div>
          </div>

          <div className="translate-y-[-1rem] animate-fade-in opacity-0 [--animation-delay:600ms] flex items-end justify-end">
            <img
              className="w-[450px] h-auto object-contain"
              alt="Imagem do whatsapp"
              src="https://c.animaapp.com/mht8rhtrvso9Rd/img/imagem-do-whatsapp-de-2025-09-16---s--10-10-26-e829a6ac-1.png"
            />
          </div>
        </div>
      </div>
    </section>
  );
};
