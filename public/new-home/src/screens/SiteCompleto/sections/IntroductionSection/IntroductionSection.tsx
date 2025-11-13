import React from "react";
import { Separator } from "../../../../components/ui/separator";

export const IntroductionSection = (): JSX.Element => {
  return (
    <section className="w-full flex flex-col items-start gap-3.5">
      <h2 className="[font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-[#373b47] text-6xl tracking-[0] leading-[60px]">
        Cátia Alexandra
      </h2>

      <Separator className="w-full max-w-[450px] h-[3px] bg-[#373b47]" />

      <p className="w-full [font-family:'Roboto',Helvetica] font-normal text-[#555555] text-xl tracking-[0] leading-[25px]">
        Meu compromisso é acompanhar cada cliente em sua jornada, com
        honestidade, acolhimento e transparência. Meu propósito é tornar
        possível o acesso de todas as pessoas ao sonho da casa própria,
        transformando objetivos em conquistas reais.
      </p>
    </section>
  );
};
