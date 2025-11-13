import React from "react";
import { Card, CardContent } from "../../../../components/ui/card";
import { Separator } from "../../../../components/ui/separator";

const locations = [
  { name: "Canoas" },
  { name: "Porto Alegre" },
  { name: "Nova Santa Rita" },
];

export const PropertyAreasSection = (): JSX.Element => {
  return (
    <section className="w-full max-w-[403px]">
      <Card className="bg-[#f7f7f7] rounded-[10px] shadow-[1px_1px_6.2px_#00000021] border-0">
        <CardContent className="p-5">
          <h2 className="text-center [font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-[#6e1010] text-[35px] tracking-[0] leading-[35.0px] mb-[23px]">
            Áreas de Atuação
          </h2>

          <Separator className="h-[3px] bg-gradient-to-r from-transparent via-[#6e1010] to-transparent mb-[23px]" />

          <div className="space-y-[15px]">
            {locations.map((location, index) => (
              <div key={index} className="space-y-3.5">
                <div className="[font-family:'Roboto',Helvetica] font-bold text-[#bb0303] text-lg tracking-[0] leading-[18.0px]">
                  {location.name}
                </div>
                {index < locations.length - 1 && (
                  <Separator className="h-px bg-[#bb0303] opacity-30" />
                )}
              </div>
            ))}
          </div>
        </CardContent>
      </Card>
    </section>
  );
};
