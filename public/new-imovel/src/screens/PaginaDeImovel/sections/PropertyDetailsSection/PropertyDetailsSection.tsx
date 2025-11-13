import { BedIcon, CarIcon, MapPinIcon, MaximizeIcon } from "lucide-react";
import React from "react";
import { Separator } from "../../../../components/ui/separator";

type Props = {
  city?: string;
  area?: number;
  bedrooms?: number;
  bathrooms?: number;
  garages?: number;
  price?: number;
};

const fmtCurrency = (v?: number) =>
  typeof v === "number" ? v.toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) : undefined;

export const PropertyDetailsSection = ({ city, area, bedrooms, bathrooms, garages, price }: Props): JSX.Element => {
  const featuresRaw = [
    { icon: MapPinIcon, text: city ?? "CANOAS - RS", iconClassName: "w-[13px] h-[17px]" },
    { icon: MaximizeIcon, text: area != null ? `${area} m²` : "220 m²", iconClassName: "w-[15px] h-[15px]" },
    { icon: BedIcon, text: bedrooms != null ? `${bedrooms} quartos` : "3 quartos", iconClassName: "w-[18px] h-[13px]" },
    { customIcon: "https://c.animaapp.com/mht9bn8iNrOJ7D/img/group.svg", text: bathrooms != null ? `${bathrooms} banheiros` : "2 banheiros", iconClassName: "w-[17px] h-[17px]" },
    { icon: CarIcon, text: garages != null ? `${garages} vagas` : "4 vagas", iconClassName: "w-[18px] h-[14px]" },
  ];
  const features = featuresRaw.filter((f) => !!f.text) as Array<{ icon?: React.ComponentType<any>; customIcon?: string; text: string; iconClassName: string }>;

  return (
    <section className="w-full flex flex-col opacity-0 translate-y-[-1rem] animate-fade-in [--animation-delay:200ms]">
      <Separator className="w-full" />

      <div className="flex flex-wrap items-center gap-8 lg:gap-[55px] mt-2.5">
        {features.map((feature, index) => (
          <div key={index} className="flex items-center gap-2 h-[25px]">
            {feature.customIcon ? (
              <img className={feature.iconClassName} alt="" src={feature.customIcon} />
            ) : feature.icon ? (
              <feature.icon className={`${feature.iconClassName} text-[#5d5d5d]`} />
            ) : null}
            <span className="[font-family:'Roboto',Helvetica] font-normal text-[#5d5d5d] text-base tracking-[0] leading-[25px] whitespace-nowrap">
              {feature.text}
            </span>
          </div>
        ))}
      </div>

      <div className="mt-[30px] [font-family:'Roboto',Helvetica] font-medium text-[#cf0605] text-4xl tracking-[0] leading-[25px] whitespace-nowrap">
        {fmtCurrency(price ?? 450000)}
      </div>
    </section>
  );
};
